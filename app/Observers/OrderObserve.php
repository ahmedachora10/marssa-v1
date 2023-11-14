<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Notification;

class OrderObserve
{
    /**
     * Handle the order "created" event.
     *
     * @param \App\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        $users = $order->store->users;
        $name = data_get($order->product, 'name_ar');
        $quantity = data_get($order, 'quantity');
        $order_id = data_get($order, 'order_id');
        $amount = data_get($order, 'amount');
        $clientName = data_get($order->client, 'name');
        $phone = data_get($order->client, 'mobile');
        $address = data_get($order->client, 'address');
        if ($users) {
            $message = " تم شراء منتج جديد من المنصة  ".PHP_EOL;
            $message .= "*اسم المنتج  :  $name*".PHP_EOL;
            $message .= "العدد :  $quantity".PHP_EOL;
            $message .= "رقم الطلب :  $order_id".PHP_EOL;
            $message .= "احمالي المبلغ :  *$amount*".PHP_EOL;
            $message .= "اسم الزبون :  $clientName".PHP_EOL;
            $message .= "*عنوان الزبون :  $address*".PHP_EOL;
            $message .= "رقم هاتف الزبون :  *$phone*".PHP_EOL;
            if (isset($users[0]->mobile)) {
                \App\Helper\Ws::make(PhoneFormat($users[0]->mobile), $message)->send();
            }
        }

    }

    /**
     * Handle the order "updated" event.
     *
     * @param \App\Order $order
     * @return void
     */
    public
    function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param \App\Order $order
     * @return void
     */
    public
    function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param \App\Order $order
     * @return void
     */
    public
    function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param \App\Order $order
     * @return void
     */
    public
    function forceDeleted(Order $order)
    {
        //
    }
}