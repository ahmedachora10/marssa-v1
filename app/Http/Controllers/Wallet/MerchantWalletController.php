<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Wallet\WalletController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\MerchantWallet;
use Mail;
use App\Mail\TechnicalSupport;

use PayPal\Api\Amount;
use PayPal\Api\Details;
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
use Session;
use Redirect;
use App\Affiliate;
use Illuminate\Support\Facades\Http;

class MerchantWalletController extends Controller implements WalletController
{
    private $apiContext;

    public function __construct()
    {

        if (config('paypal.settings.mode') == 'live') {
            $this->clientId = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->clientId = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }

        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    //
    public function show_wallet()
    {
        $merchant = auth()->user();
        $Context = [
            'title_page' => 'wallet',
            'wallet_payments' => $merchant->wallet_payments()->latest()->get(),
            'wallet_total' => $merchant->wallet_total
        ];
        return view('dashboard.wallet.wallet')->with($Context);
    }
    
    
    public function pay_commission_auto() {
        // if(auth()->user()->store->plan->is_commission == 1) {
        //     if(auth()->user()->plan->max_indebtedness <= auth()->user()->store->indebtedness) {
        //         $this->pay_commission();
        //     }
        // }
        
    }
    
    public function pay_commission() {
        
        $amounttoPay = auth()->user()->store->indebtedness;
        $totalWallet = auth()->user()->wallet_total;
        $merchant = auth()->user();
        if($totalWallet >= $amounttoPay) {
            $pay = new MerchantWallet();
            $pay->amount = $amounttoPay;
            
            $latest = MerchantWallet::where('store_id',auth()->user()->store->id)->first();
            if($latest != null && $latest->type_method != 'Pay Commission') {
                $pay->type_method = $latest->type_method;
            } else if ($latest != null && $latest->type_method == 'Pay Commission') {
                $pay->type_method = 'Pay Commission';    
            } else {
                $pay->type_method = 'Pay Commission';
            }
            
            $pay->type_operation = 1;
            $pay->status = 1;
            $pay->merchant()->associate($merchant);
            $pay->store()->associate($merchant->store);
            $pay->save();
            
            auth()->user()->store->indebtedness = 0;
            auth()->user()->store->status = 1;
            auth()->user()->store->save();
            
            $store = auth()->user()->store;
            $total_count = MerchantWallet::where(['store_id'=>$store->id,'type_method'=>'Pay Commission'])->count();
                        if($total_count > 3){
                                
                             $store->max_indebtedness = ($max_indebtedness * 1.5 ) + $max_indebtedness;
                             $store->save();
                             $total_pays = MerchantWallet::where(['store_id'=>$store->id,'type_method'=>'Pay Commission'])->get();
                             foreach($total_pays as $total) {
                                 $total->type_method = 'Pay Commission_1';
                                 $total->save();
                             }
                             
                        } else  {
                            $total_count = MerchantWallet::where(['store_id'=>$store->id])->where('type_method','like', '%Pay Comission%')->count();
                            if($total_count >= 3) {
                                $keyInString = MerchantWallet::where(['store_id'=>$store->id])->where('type_method','like', '%Pay Comission%')->first();
                                $keyInArray = explode("_",$KeyInString);
                                $key = count($keyInArray) == 2 ? $keyInArray[1] : 0;
                                if($key != 0) {
                                    $precent = $key * 1.5;
                                    $store->max_indebtedness = ($max_indebtedness * $precent ) + $max_indebtedness;
                                    $store->save();
                                    
                                    $total_pays = MerchantWallet::where(['store_id'=>$store->id])->where('type_method','like', '%Pay Comission%')->get();
                                    $next = $key + 1;
                                    foreach($total_pays as $total) {
                                        $total->type_method = 'Pay Commission_'+$next;
                                        $total->save();
                                    }
                                    
                                }
                            }
                        }
            
            return back();
        } else {
            return back();
        }
        
        //getAmount
    }
    
    public function recharge()
    {
        $stores = Store::all();
        return view('dashboard.wallet.recharge', ['model' => $stores, 'title_page' => 'manual_recharge']);
    }

    public function save_recharge(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'amount' => 'required|numeric',
        ]);
        $merchant = Store::findOrFail($request->store_id);
        $user = $merchant->users()->first();
        $pay = new MerchantWallet();
        $pay->amount = $request->amount;
        $pay->type_method = 'bankily';
        $pay->type_operation = 0;
        $pay->token = md5(now());
        $pay->pay_id = uniqid();
        $pay->payer_id = uniqid();
        $pay->status = 1;
        $pay->merchant()->associate($user);
        $pay->store()->associate($merchant);
        $pay->save();
        $this->calculate_direct_affiliate_percentage($pay->id);
        Alert::success(__("Done"));
        return back();
    }

    public function add_balance_in_wallet(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'value-charge' => 'required|gte:900|lte:15000',
            'paymentMethod' => 'required',
        ]);

        $validate->sometimes('bill', 'required|max:2500|image|mimes:jpg,png,jpeg', function ($input) {
            return $input->paymentMethod == 'bankily';
        });

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        if ($request->input('paymentMethod') != 'paypal'):
            return $this->useing_transfer_money_method_charge($request);
        else:
            return $this->{"useing_" . $request->input('paymentMethod') . "_method_charge"}($request);
        endif;


        return redirect()->back();

    }


    public function useing_paypal_method_charge($data)
    {
        $total = self::getAmount(env('currency_name'), $data['value-charge']);
        session::put('total_before_exchange', self::check_commission_on_balance($data['value-charge']));
        $total_amount = number_format((float)$total, 2, '.', '');
        $des = "Charge your wallet with money";

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $name = "Wallet-" . auth()->user()->id . strtotime(date('Y-m-d m:i:s'));
        $item->setName($name)->setCurrency('USD')->setQuantity(1)->setDescription($des)->setPrice($total_amount);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($total_amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription($des);

        $redirectUrls = new RedirectUrls();

        $redirectUrls->setReturnUrl(route('dashboard.admin.wallet_paypal_success'))->setCancelUrl(route('dashboard.admin.wallet_paypal_failure'));

        $payment = new Payment();
        $payment->setIntent("sale")->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $e) {
            return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
        }
        $paymentLink = $payment->getApprovalLink();
        return redirect($paymentLink);
    }

    public function useing_transfer_money_method_charge($data)
    {
        $merchant = auth()->user();
        $pay = new MerchantWallet();
        $pay->amount = self::check_commission_on_balance($data['value-charge']);
        $pay->type_method = $data['paymentMethod'];
        $pay->type_operation = $data['type_operation'] ?? 0;
        

        $pay->bill = self::handle_bill_file($data);

        $pay->merchant()->associate($merchant);
        $pay->store()->associate($merchant->store);
        if ($pay->save()) {
            $response = 'عملية دفع بحاجة لتحقق ، للمستخدم ' . $merchant->name . ', نرجو مراجعة الفاتورة والتحقق من علمية الدفع؛ لتفاصيل أكثر نرجو زيارة لوحة التحكم الخاصة بالمنصة.';
            $data_message = array('status' => 'payment', 'id' => $pay->id, 'name' => 'SuperManager', 'response' => $response);
            self::send_notify_technical_support($data_message);
        }

        return redirect()->back()->with('message', 'payment_pending');
    }

    public static function handle_bill_file($data)
    {
        $bill = $data->file(['bill']);
        if (empty($bill))
            return;


        $fileName = 'bill-' . time() . '.' . $bill->getClientOriginalExtension();
        $bill->move(public_path('/files'), $fileName);
        return 'files/' . $fileName;
    }

    public static function send_notify_technical_support($data_message)
    {
        try {
            Mail::to(env('MAIL_NOTIFY'), 'SuperManager')
                ->cc(env('MAIL_USERNAME'), env('APP_NAME'))
                ->send(new TechnicalSupport($data_message));
        } catch (Exception $e) {
        }
    }

    public static function getAmount($currency, $amount = '')
    {
        $pair = $currency;
        if ($currency !== 'USD') {
            $api = Http::get('https://v6.exchangerate-api.com/v6/0efeb3f7b0d11058beeeb41a/latest/USD');
            $data = $api->json();
            if ($data['result'] == 'success') {
                $amount = str_replace(',', '', $amount);
                return round(((int)$amount / $data['conversion_rates'][$currency]), 2);
            }
        }
        return $data;
    }

    public function paypal_success(Request $request)
    {

        if (empty($request->PayerID) || empty($request->token)) {
            return redirect('dashboard.admin.wallet_paypal_failure');
        }
        if (isset($request->paymentId)) {
            $data = $request->all();
            $paymentId = $data['paymentId'];
            try {
                DB::beginTransaction();
                $payment = Payment::get($paymentId, $this->apiContext);
                $execution = new PaymentExecution();
                $execution->setPayerId($request->PayerID);
                $result = $payment->execute($execution, $this->apiContext);
                $payment->create($this->apiContext);
                if ($result->getState() == 'approved') {
                    $result = $result->transactions[0];
                    $merchant = auth()->user();
                    $pay = new MerchantWallet();
                    $pay->amount = session::get('total_before_exchange');
                    $pay->type_method = 'PayPal';
                    $pay->type_operation = 0;
                    $pay->token = $data['token'];
                    $pay->pay_id = $data['paymentId'];
                    $pay->payer_id = $data['PayerID'];
                    $pay->status = 1;
                    $pay->merchant()->associate($merchant);
                    $pay->store()->associate($merchant->store);
                    $pay->save();
                    $this->calculate_direct_affiliate_percentage($pay->id);
                    $message = 'payment_success';
                    DB::commit();
                } else {
                    $message = 'payment_failed';
                    DB::rollBack();
                }
                return redirect(route('dashboard.admin.wallet'))->with('message', $message);
            } catch
            (\Exception $e) {
                return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
            }
        } else {
            return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
        }
    }
    
    
    
    
    public function paypal_success_v2(Request $request)
    {

        if (isset($request->paymentId)) {
            $data = $request->all();
            $paymentId = $data['paymentId'];
            try {
                DB::beginTransaction();
                $payment = Payment::get($paymentId, $this->apiContext);
                $execution = new PaymentExecution();
                $execution->setPayerId($request->PayerID);
                $result = $payment->execute($execution, $this->apiContext);
                $payment->create($this->apiContext);
                if ($result->getState() == 'approved') {
                    $result = $result->transactions[0];
                    $merchant = auth()->user();
                    $pay = new MerchantWallet();
                    $pay->amount = session::get('total_before_exchange');
                    $pay->type_method = 'PayPal';
                    $pay->type_operation = 0;
                    $pay->token = $data['token'];
                    $pay->pay_id = $data['paymentId'];
                    $pay->payer_id = $data['PayerID'];
                    $pay->status = 1;
                    $pay->merchant()->associate($merchant);
                    $pay->store()->associate($merchant->store);
                    $pay->save();
                    $this->calculate_direct_affiliate_percentage($pay->id);
                    $message = 'payment_success';
                    DB::commit();
                } else {
                    $message = 'payment_failed';
                    DB::rollBack();
                }
                return redirect(route('dashboard.admin.wallet'))->with('message', $message);
            } catch
            (\Exception $e) {
                return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
            }
        } else {
            return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
        }
    }
    
    
    


    public function paypal_failure()
    {
        return redirect(route('dashboard.admin.wallet'))->with('message', 'payment_failed');
    }

    public static function withdraw_amount_from_wallet($data)
    {
        $merchant = auth()->user();
        if ($merchant->wallet_total >= $data['total_amount']) {
            $pay = new MerchantWallet();
            $pay->amount = $data['total_amount'];
            $pay->type_method = 'withdraw';
            $pay->type_operation = 1;
            $pay->status = 1;
            $pay->merchant()->associate($merchant);
            $pay->store()->associate($merchant->store);
            $pay->save();
            return ['status' => 'success'];
        }
        return ['status' => 'failed'];
    }


    public function wallet_orders()
    {
        $wallet_stores = MerchantWallet::all();
        $Context = [
            'wallet_stores' => $wallet_stores,
            'title_page' => 'wallet_stores'
        ];
        return view('dashboard.wallet.wallet_charge_orders')->with($Context);
    }

    public function wallet_charge_order_edit($store_id)
    {
        $wallet_store = MerchantWallet::find($store_id);
        $Context = [
            'wallet_store' => $wallet_store,
            'title_page' => 'wallet_order_edit'
        ];
        return view('dashboard.wallet.wallet_charge_orders_edit')->with($Context);
    }

    public function wallet_charge_order_update(Request $request)
    { 
        if($request->status == 1){
            $merchantWallet = MerchantWallet::where(['id'=>$request->id,'type_operation'=>0])->first();
            if($merchantWallet->merchant->affiliatee){
                $affiliate = Affiliate::where('id',$merchantWallet->merchant->reference_affiliate_id)->first();
                if($affiliate->status_affiliate_rate == 0 || ($merchantWallet->merchant->invitee_profit->count() < $affiliate->status_affiliate_rate )){
                    $affiliate->profits()->create([
                     'invitee_id' => $merchantWallet->user_id,
                     'value'      => $this->calculate_affiliate_percentage($merchantWallet->amount)
                    ]);
                }
            }
        }
        
        MerchantWallet::where('id', $request->id)->update(['status' => $request->status]);
        return back();
    }
    
    public function calculate_direct_affiliate_percentage($id){
        $merchantWallet = MerchantWallet::where(['id'=>$id,'type_operation'=>0])->first();
        if($merchantWallet->merchant->affiliatee){
            $affiliate = Affiliate::where('id',$merchantWallet->merchant->reference_affiliate_id)->first();
            if($affiliate->status_affiliate_rate == 0 || ($merchantWallet->merchant->invitee_profit->count() < $affiliate->status_affiliate_rate )){
                $affiliate->profits()->create([
                 'invitee_id' => $merchantWallet->user_id,
                 'value'      => $this->calculate_affiliate_percentage($merchantWallet->amount)
                ]);
            }
        }
    }

    public static function check_commission_on_balance($amount)
    {
        $total = $amount + (($amount * env('commission', 0)) / 100);
        return $total;
    }
    
    public static function calculate_affiliate_percentage($amount)
    {
        $total = (($amount * env('affiliate_rate', 20)) / 100);
        return $total;
    }


}
