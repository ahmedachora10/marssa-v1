<?php

namespace App\Http\Controllers;

use App\OrderPayment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  OrderPayment  $orderPayment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  OrderPayment  $orderPayment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  OrderPayment  $orderPayment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, OrderPayment $orderPayment)
    {
        $data = $request->validate([
            'status' => 'required|in:0,1,2'
        ]);
        $orderPayment->update($data);
        toast(__('master.Successfully'),'success');
        //Alert::success(__('master.Successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  OrderPayment  $orderPayment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderPayment $orderPayment)
    {
        //
    }
}
