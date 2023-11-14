<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductReview;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductReviewsController extends Controller
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
            $Reviews = ProductReview::with(['store','product'])->whereStoreId($auth_user->store->id)->orderByDesc('id')->paginate(12);
        } else {
            $Reviews = ProductReview::with(['store','product'])->orderBy('id', 'DESC')->paginate(12);
        }
        $context['Reviews'] = $Reviews;
        return view('dashboard.Reviews', $context);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $context = [
            'title_page' => 'add_new',
            'review' => false,
            'products'=> Product::whereStoreId(auth()->user()->store->id)->get(),
            'route' => route('dashboard.admin.Reviews.add'),
        ];
        return view('dashboard.add_review',$context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'rate'=>'required|in:0,1,2,3,4,5',
            'full_name'=>'required|string',
            'product_id'=>'required',
            'phone'=>'sometimes',
            'email'=>'sometimes',
            'content'=>'required',
            'status'=>'required'
        ]);
        ProductReview::create($data);
        toast(__('master.Successfully'),'success');
        //Alert::success(__('master.Successfully'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  ProductReview  $productReview
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
     * @param  ProductReview  $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReview $productReview)
    {
        $context = [
            'title_page' => 'add_new',
            'review' => $productReview,
            'products'=> Product::whereStoreId(auth()->user()->store->id)->get(),
            'route' => route('dashboard.admin.Reviews.update',[$productReview->id]),
        ];
        return view('dashboard.add_review',$context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  ProductReview  $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductReview $productReview)
    {

        $data = $request->validate([
            'rate'=>'required|in:0,1,2,3,4,5',
            'full_name'=>'required|string',
            'product_id'=>'required|integer',
            'phone'=>'sometimes',
            'email'=>'sometimes',
            'content'=>'required',
            'status'=>'required'
        ]);
        $productReview->update($data);
        toast(__('master.Successfully'),'success');
        //Alert::success(__('master.Successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProductReview  $productReview
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReview $productReview)
    {
        $productReview->delete();
        toast(__('master.Successfully'),'success');
        //Alert::success(__('master.Successfully'));
        return redirect()->back();
    }
}
