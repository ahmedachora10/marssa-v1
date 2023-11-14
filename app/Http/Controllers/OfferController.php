<?php

namespace App\Http\Controllers;

use App\Upsell;
use Illuminate\Http\Request;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $context = ['title_page' => 'offers'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $offers = $auth_user->store()->first()->offers()->orderBy('id', 'DESC')->paginate(12);
        } else {
            $offers = Offer::orderBy('id', 'DESC')->paginate(12);
        }
        $context['offers'] = $offers;
        return view('dashboard.offers', $context);
    }

    public function upsell()
    {

        $context = ['title_page' => 'upsell'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $upsells = $auth_user->store()->first()->upsell()->orderBy('id', 'DESC')->paginate(12);
        } else {
            $upsells = Upsell::orderBy('id', 'DESC')->paginate(12);
        }
        $context['upsells'] = $upsells;
        $store = $auth_user->store()->first();
        return view('dashboard.upsell', $context, compact('store'));
    }

    public function add()
    {
        $auth_user = auth()->user();
        $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
        $context = [
            'title_page' => 'add_new',
            'products' => $products,
            'offer' => false,
            'route' => route('dashboard.admin.offers.add'),
        ];
        return view('dashboard.add_offer', $context);
    }

    public function add_upsell()
    {

        $auth_user = auth()->user();
        $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
        $store = $auth_user->store()->first();
        if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        else
            $language = ['ar', 'en', 'fr'];
        $context = [
            'title_page' => 'add_new',
            'language' => $language,
            'products' => $products,
            'upsell' => false,
            'route' => route('dashboard.admin.upsell.add'),
        ];
        return view('dashboard.add_upsell', $context);
    }


    public function offer_add(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $validator = Validator::make($data, [
            'product' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $store = $auth_user->store()->first();
        $product = $store->products()->whereId($data['product'])->first();

        $offers = $store->offers()->whereMonth('updated_at', '=', Carbon::now()->subMonth()->month + 1)->get();
        if (count($offers) > (int)$store->plan()->first()->offer_count) {
            return redirect()->back()->with('message', 'Fail');
        }

        $validator = Validator::make($data, [
            'offer_start' => ['required', 'date'],
            'offer_end' => ['required', 'date', 'after:offer_start'],
            'discount_offer' => ['required', 'numeric', 'lt:' . $product->price],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }

        $offer = new Offer();
        $offer['start'] = date('Y/m/d', strtotime($data['offer_start']));
        $offer['end'] = date('Y/m/d', strtotime($data['offer_end']));
        $offer['discount'] = $data['discount_offer'];
        $offer->store()->associate($store);
        $offer->product()->associate($product);
        if ($offer->save()) {
            $product->offers()->update(['status' => false]);
            $offer->update(['status' => true]);
        }
        return redirect()->route('dashboard.admin.offers');
    }

    public function store_upsell(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $validator = Validator::make($data, [
            'product_id' => ['required'],
            'offer_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $store = $auth_user->store()->first();
        $new = new Upsell();
        $new->product_id = $request->product_id;
        $new->offer_id = $request->offer_id;
        $new->cancel_color = $request->cancel_color;
        $new->accept_color = $request->accept_color;
        $new->show_product_image = $request->show_product_image ?? ' ';
        if (isset($request->status) && $request->status == 'on') {
            $new->status = 'active';
        }
        $new->store_id = $store->id;
        if (array_key_exists("title_ar", $data)) $new['title_ar'] = $data['title_ar'];
        if (array_key_exists("title_en", $data)) $new['title_en'] = $data['title_en'];
        if (array_key_exists("title_fr", $data)) $new['title_fr'] = $data['title_fr'];
        if (array_key_exists("desc_ar", $data)) $new['desc_ar'] = $data['desc_ar'];
        if (array_key_exists("desc_en", $data)) $new['desc_en'] = $data['desc_en'];
        if (array_key_exists("desc_fr", $data)) $new['desc_fr'] = $data['desc_fr'];
        if (array_key_exists("accept_ar", $data)) $new['accept_ar'] = $data['accept_ar'] ?? '-';
        if (array_key_exists("accept_en", $data)) $new['accept_en'] = $data['accept_en'] ?? '-';
        if (array_key_exists("accept_fr", $data)) $new['accept_fr'] = $data['accept_fr'] ?? '-';
        if (array_key_exists("cancel_ar", $data)) $new['cancel_ar'] = $data['cancel_ar'] ?? '-';
        if (array_key_exists("cancel_en", $data)) $new['cancel_en'] = $data['cancel_en'] ?? '-';
        if (array_key_exists("cancel_fr", $data)) $new['cancel_fr'] = $data['cancel_fr'] ?? '-';
        $new->save();

        return redirect()->route('dashboard.admin.upsell');

    }

    public function offer_delete($id)
    {
        $auth_user = auth()->user();
        $offer = $auth_user->store()->first()->offers()->whereId($id)->first();
        if (!$offer) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $offer->delete();
        toast(__('master.Successfully'), 'success');
        return back();
        //return back()->with('success', 'Successfully');
    }

    public function upsell_delete($id)
    {

        $auth_user = auth()->user();
        $offer = $auth_user->store()->first()->upsell()->whereId($id)->first();
        if (!$offer) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $offer->delete();
        toast(__('master.Successfully'), 'success');
        return back();
        //return back()->with('success', 'Successfully');
    }


    public function offer_edit($id)
    {
        $auth_user = auth()->user();
        $offer = $auth_user->store()->first()->offers()->whereId($id)->first();
        if ($offer) {
            $route = route('dashboard.admin.offers.update', ['id' => $id]);
            $context = [
                'title_page' => 'offer_edit',
                'offer' => $offer,
                'route' => $route
            ];
            return view('dashboard.add_offer', $context);
        }
        return redirect()->back();
    }

    public function upsell_edit($id)
    {
        $auth_user = auth()->user();
        $upsell = $auth_user->store()->first()->upsell()->whereId($id)->first();
        $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
        $store = $auth_user->store()->first();
        if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        else
            $language = ['ar', 'en', 'fr'];
        if ($upsell) {
            $route = route('dashboard.admin.upsell.update', ['id' => $id]);
            $context = [
                'title_page' => 'upsell_edit',
                'upsell' => $upsell,
                'route' => $route,
                'products' => $products,
                'language' => $language,

            ];
            return view('dashboard.add_upsell', $context);
        }
        return redirect()->back();

    }

    public function offer_update(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $offer = $auth_user->store()->first()->offers()->whereId($data['id'])->first();
        if ($offer) {
            $price = $offer->product()->first()->price;
            $validator = Validator::make($data, [
                'offer_start' => ['required', 'date'],
                'offer_end' => ['required', 'date', 'after:offer_start'],
                'discount_offer' => ['required', 'numeric', 'lt:' . $price],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($data)->withErrors($validator->errors());
            }
            $offer->update([
                'start' => date('Y/m/d', strtotime($data['offer_start'])),
                'end' => date('Y/m/d', strtotime($data['offer_end'])),
                'discount' => $data['discount_offer'],
            ]);
        }
        return redirect(route('dashboard.admin.offers'));
    }

    public function upsell_update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'product_id' => ['required'],
            'offer_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $new = Upsell::findOrFail($request->id);
        $new->product_id = $request->product_id;
        $new->offer_id = $request->offer_id;
        $new->cancel_color = $request->cancel_color;
        $new->accept_color = $request->accept_color;
        $new->show_product_image = $request->show_product_image;
        if (isset($request->status) && $request->status == 'on') {
            $new->status = 'active';
        } else {
            $new->status = 'inactive';
        }
        $new->store_id = $store->id;
        if (array_key_exists("title_ar", $data)) $new['title_ar'] = $data['title_ar'];
        if (array_key_exists("title_en", $data)) $new['title_en'] = $data['title_en'];
        if (array_key_exists("title_fr", $data)) $new['title_fr'] = $data['title_fr'];
        if (array_key_exists("desc_ar", $data)) $new['desc_ar'] = $data['desc_ar'];
        if (array_key_exists("desc_en", $data)) $new['desc_en'] = $data['desc_en'];
        if (array_key_exists("desc_fr", $data)) $new['desc_fr'] = $data['desc_fr'];
        if (array_key_exists("accept_ar", $data)) $new['accept_ar'] = $data['accept_ar'];
        if (array_key_exists("accept_en", $data)) $new['accept_en'] = $data['accept_en'];
        if (array_key_exists("accept_fr", $data)) $new['accept_fr'] = $data['accept_fr'];
        if (array_key_exists("cancel_ar", $data)) $new['cancel_ar'] = $data['cancel_ar'];
        if (array_key_exists("cancel_en", $data)) $new['cancel_en'] = $data['cancel_en'];
        if (array_key_exists("cancel_fr", $data)) $new['cancel_fr'] = $data['cancel_fr'];
        $new->save();
        return redirect()->route('dashboard.admin.upsell');
    }

}
//Developed Saed Z. Sinwar