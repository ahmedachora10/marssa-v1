<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductReview;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategorizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $context = ['title_page' => 'Reviews'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $category = Category::with(['store', 'products'])->whereStoreId($auth_user->store->id)->orderByDesc('id')->paginate(12);
        } else {
            $category = Category::with(['store', 'products'])->whereStoreId($auth_user->store->id)->orderByDesc('id')->paginate(12);
        }
        $context['category'] = $category;
        return view('dashboard.category', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $context = [
            'title_page' => 'add_category',
            'products' => Product::whereStoreId(auth()->user()->store->id)->get(),
            'route' => route('dashboard.admin.categorize.add'),
        ];
        return view('dashboard.add_category', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
           /* 'name_en' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',*/
        ]);
        $data['store_id'] = auth()->user()->store->id;
        $data['name_en'] = $data['name_ar'];
        $data['name_fr'] = $data['name_ar'];
    
        $data['status'] = $request['status'] ?? false;
        Category::create($data);
        toast(__('master.Successfully'),'success');
        return redirect()->back();
        /*$response['response'] = __('master.Successfully');
        $response['success'] = true;
        return $response;*/
    }

    /**
     * Display the specified resource.
     *
     * @param ProductReview $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductReview $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $context = [
            'title_page' => 'edit_category',
            'category' => Category::whereStoreId(auth()->user()->store->id)->findOrFail($id),
            'route' => route('dashboard.admin.categorize.update', [$id]),
        ];
        return view('dashboard.edit_category', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProductReview $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
        ]);
        $data['store_id'] = auth()->user()->store->id;
        
        $data['status'] = $request['status'] ?? false;
        //dd($data);
        Category::whereStoreId(auth()->user()->store->id)->findOrFail($id)->update($data);
        //Alert::success(__('master.Successfully'));
        toast(__('master.Successfully'),'success');
        return redirect()->back();
        /*$response['response'] = __('master.Successfully');
        $response['success'] = true;
        return $response;*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductReview $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auth_user = auth()->user();
        $cat = Category::whereStoreId($auth_user->store->id)->findOrFail($id);
        Product::whereStoreId($auth_user->store->id)->whereCategoryId($id)->update([
            'category_id' => null
        ]);
        $cat->delete();
        toast(__('master.Successfully'),'success');
        //Alert::success(__('master.Successfully'));
        return redirect()->back();
        /*['response'] = __('master.Successfully');
        $response['success'] = true;
        return $response;*/
    }
}
