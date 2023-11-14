<?php

namespace App\Http\Controllers;

use App\Client;
use App\CustomDomain;
use App\Order;
use App\OrderPayment;
use App\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use RealRashid\SweetAlert\Facades\Alert;

class PayPalController extends Controller
{

    public function Store(Request $request,$domain='')
    {
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);

            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }

        }
        return Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
    }


    static function getAmount($currency,$amount=''){
        $pair = $currency;
        if ($currency !== 'USD') {
//            $api = Http::get('https://www.freeforexapi.com/api/live?pairs='.$pair);
            $api = Http::get('http://api.currencylayer.com/live?access_key='.env('CURRENCYLAYER').'&currencies='.$pair.'&format=1');
            $data = $api->json();
            if ($data['success']) {
                $amount = str_replace(',','',$amount);
                return round(((int) $amount / $data['quotes']['USD'.$currency]),2);
            }
        }
        return $amount;
    }
    static function make_payment($data,$store){
        if ($store->payment_methods['paypal']['paypal_type'] == 'live') {
            $clientId = $store->payment_methods['paypal']['paypal_client_id'];
            $secret = $store->payment_methods['paypal']['paypal_secret'];
        } else {
            $clientId = $store->payment_methods['paypal']['paypal_client_id'];
            $secret = $store->payment_methods['paypal']['paypal_secret'];
        }
        $apiContext = new ApiContext(new OAuthTokenCredential($clientId, $secret));
        $apiContext->setConfig(config('paypal.settings'));
        $cartTotal = Cart::total();
        $cartItem = Cart::content();
        $priceinUSD = self::getAmount($store->getCurrency(),Cart::total());

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName($cartItem->first()->name)->setCurrency('USD')->setQuantity(1)->setPrice($priceinUSD);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($priceinUSD);

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/paypal_success'))->setCancelUrl(url('/paypal_failure'));
        $payment = new Payment();
        $payment->setIntent("sale")->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions(array($transaction));
        try {
            $payment->create($apiContext);
        } catch (\PayPal\Exception\PPConnectionException $e) {
            return redirect(url('/'));
        }

        $paymentLink = $payment->getApprovalLink();
        return redirect($paymentLink);
    }

    public function paypal_success(Request $request,$domain='')
    {
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            
            toast(__('master.Fail'),'error');
            //Alert::error(__('master.Fail'));
            return redirect(url('/'));
        }
        $store = $this->Store($request,$domain);

        if (!is_null($store->shipping)) {
            Cart::addCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING,$store->shipping);
        }
        if (\Session::has('promo_discount')){
            Cart::addCost('promo',\Session::get('promo_discount'));
        }
        $data = $request->all();
        $oldRequest = \Session::get('request_data');
        $cartItem = Cart::content();

        if ($store->payment_methods['paypal']['paypal_type'] == 'live') {
            $clientId = $store->payment_methods['paypal']['paypal_client_id'];
            $secret = $store->payment_methods['paypal']['paypal_secret'];
        } else {
            $clientId = $store->payment_methods['paypal']['paypal_client_id'];
            $secret = $store->payment_methods['paypal']['paypal_secret'];
        }
        $apiContext = new ApiContext(new OAuthTokenCredential($clientId, $secret));
        $apiContext->setConfig(config('paypal.settings'));

        $paymentId = $data['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        $result = $payment->execute($execution, $apiContext);
        if ($result->getState() == 'approved') {
            $result = $result->transactions[0];

            $order_id = Str::random(10);
            $order_payment_data = [
                'status' =>(boolean) true,
                'cart'=>[
                    'currency'=> $store->getCurrency(),
                    'subtotal'=> (int) Cart::subtotal(),
                    'tax'=>(int) 0,
                    'shipping'=>(int) Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING),
                    'promo_code'=>[
                        'status'=> (Cart::getCost('promo') == "0.00") ? false : true,
                        'discount'=>(int) Cart::getCost('promo'),
                        'code'=> (Session::has('promo_code')) ? Session::get('promo_code') : false
                    ],
                    'total'=> (int) Cart::total()
                ],
                'paypal_details'=> [
                    'pay_id'=>$data['paymentId'],
                    'token'=>$data['token'],
                    'type'=>'PAYPAL',
                    'PayerID'=>$data['PayerID'],
                    'amount_total'=>$result->amount->total . ' USD',
                ],
                'note'=> ($oldRequest['more_details']) ?? null,
                'img'=> null
            ];
            $order_payment_data['type'] = 'paypal';
            $order_payment_type = 2;

            $order_payment = new OrderPayment();
            $order_payment->status = 1;
            $order_payment->data = $order_payment_data;
            $order_payment->type = $order_payment_type;
            $order_payment->save();

            foreach ($cartItem as $item) {
                $product = $store->products()->whereId($item->id)->where('status', '<>', '0')->first();
                if (!$product) {
                    return route('store.index', ['sub_domain' => $store->domain]);
                }
                $offer = $product->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
                $price = $product->price;
                $quantity = (int)abs($item->qty ?? 1);
                $order = new Order();
                $discount = 0;
                if ($offer) {
                    $discount += (($price - $offer->discount) * $quantity);
                    $price = $offer->discount;
                    $order->offer()->associate($offer);
                }
                $client = Client::updateOrCreate([
                    'mobile' => $oldRequest['mobile'],
                    'store_id' => $store->id
                ],[
                    'mobile' => $oldRequest['mobile'],
                    'name' => ($oldRequest['name']) ?? '',
                    'email' => ($oldRequest['email']) ?? '',
                    'address' => ($oldRequest['address']) ?? ''
                ]);

                if ($price < 0) $price = 0;
                $order['amount'] = $price * $quantity;
                $order['quantity'] = $quantity;
                $order['discount'] = $discount;
                $order['currency'] = $store->getCurrency();
                $order['order_id'] = $order_id;
                $order->client()->associate($client);
                $order->store()->associate($store);
                $order->product()->associate($product);
                $order->payment()->associate($order_payment);
                $order->save();
            }
            Cart::destroy();
            $request->session()->forget('request_data');
            return redirect(url('/thank_you?orderId='.$order_id));
        }
        if (\Session::has('promo_discount')){
            \Session::remove('promo_discount');
            \Session::remove('promo_code');
        }
        toast(__('master.you_cancel_payment_or_theres_error'),'error');
        //Alert::error(__('master.Fail'),__('master.you_cancel_payment_or_theres_error'));
        return redirect(url('/'));
    }

    public function paypal_failure(Request $request)
    {
        toast(__('master.you_cancel_payment_or_theres_error'),'error');
        //Alert::error(__('master.Fail'),__('master.you_cancel_payment_or_theres_error'));
        return redirect(url('/'));
    }
}
