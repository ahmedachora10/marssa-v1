<?php

namespace App\Http\Controllers\Auth;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Page;
use App\Providers\RouteServiceProvider;
use App\Store;
use App\Plan;
use App\Subscribe;
use App\Information;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use IP2LocationLaravel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notification;
use URL;
use Auth;
use Session;
use Twilio\Rest\Client;
use App\Affiliate;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();
        $feedback = Feedback::all()->shuffle()->take(4);
        $context = [
            'information' => $information,
            'feedback' => $feedback,
        ];
        return view('auth.register',$context);
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Login;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     
   
    protected function validator(array $data)
    {
       // dd($data);
    return    Validator::make($data, [
            'store_name' => ['required', 'string','max:255'],//'unique:stores,name', 
           // 'store_url' => ['required', 'alpha_dash', 'max:255', 'unique:stores,domain', 'regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/'],//
            'password' => ['required', 'string', 'min:4'],
            'international_mobile' => ['required', 'unique:users,mobile', 'string'],//
        ]);
        
//  $validator=   return $validator;
    }

    /**if ($validator->fails()) {
        return redirect('/register')
            ->withErrors($validator)
            ->withInput();
    }
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        /*require __DIR__ . '/Twilio/autoload.php';
        $sid    = "AC395e471ed3843cef0bfa90a2abd19f4d";
        $token  = "6d5dc6af46cd291ec07acce053f65b64";
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
                          ->create("whatsapp:+213781846588", // to
                                   array(
                                       "from" => "whatsapp:+14155238886",
                                       "body" => "Your Yummy Cupcakes Company order of 1 dozen frosted cupcakes has shipped and should be delivered on July 10, 2019. Details: http://www.yummycupcakes.com/"
                                   )
                          );

        print($message->sid);*/ 
    $this->validator($data);
    
        $information = Information::create([
            'logo' => '/dashboard/light/assets/images/sativa.png',
            'icon' => '/dashboard/light/assets/images/sativa.png',
            'preview' => '/dashboard/light/assets/images/sativa.png',
            'title_page_ar' => $data['store_name'],
            'title_page_en' => $data['store_name'],
            'first_time' => 0,
        ]);
        \DB::beginTransaction();
        $store = new Store();
        $store['name'] = $data['store_name'];
        $store['design'] = 5;
        $store->information()->associate($information);
        $store->save();
        $store->update(['domain' => 'Store'.$store->id]);
        $id = $store->id;
        $privacy = privacy();
        $privacy['store_id'] = $id;
        Page::create($privacy);
        $terms = terms();
        $terms['store_id'] = $id;
        Page::create($terms);
        $refundPage = refundPage();
        $refundPage['store_id'] = $id;
        Page::create($refundPage);
        $free_plan = Plan::where('is_commission',1)->first();


        if ($free_plan) {
            $subscribe = new Subscribe();
            $subscribe['deadline'] = \Carbon\Carbon::now()->addDays(99);
            $subscribe->store()->associate($store);
            $subscribe->plan()->associate($free_plan);
            
            $store->max_indebtedness = $free_plan->max_indebtedness;
            $store->indebtedness_percent = $free_plan->commission_precent;
            $store->save();
        $store->update(['domain' => 'Store'.$store->id]);
            if ($subscribe->save()) {
                $store->update(['status' => true, 'plan_id' => $free_plan->id]);
            }
        }

        $user = new User();
        $user['name'] = $data['store_name'];
        $user['username'] = $store->domain ;
//        $user['email'] = $data['email'];
        $user['password'] = Hash::make($data['password']);
        $user['permission'] = 2;

        $user['mobile'] = $data['international_mobile'];
        $user['code_country'] = $data['_country_mobile_code_country'];

        // start affiliate system
        if(Session::has('refrence_affiliate_id') || $data['refrence_affiliate_id'] ){
            $affiliate = Affiliate::where([
                'code_affiliate' => Session::get('refrence_affiliate_id') ? Session::get('refrence_affiliate_id') : $data['refrence_affiliate_id'] ,
                'status'         => 1
            ])->first();


            if($affiliate){
                $user['reference_affiliate_id'] = $affiliate->id;
            }
        }
        // end affiliate system

        $user->store()->associate($store);
        $user->save();
        $user->assignRole('User');
        \DB::commit();

        return $user;
        Auth::logout();
        Session::flush();
        #  return redirect()->route('otp-verify');
        return redirect('/login')->with('success_registration', 'تم التسجيل بنجاح ، قم بادخال اسم متجرك و كلمة السر للدخول الى لوحة التحكم الخاصة بك');;

    }
}
//Developed Saed Z. Sinwar
