<?php

use App\Http\Controllers\AbandonedOrdersController;
use App\Http\Controllers\AdminAnalyze;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvancedController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\AffiliateMarketPlaceController;
use App\Http\Controllers\affiliatersController;
use App\Http\Controllers\AffilitersMarketPlaceController;
use App\Http\Controllers\Auth\OtpMobileVerifyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\WhatsappResetPassword;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CalculationsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\CustomDomainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExplanationController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FrontCompetitionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingStore;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\NewLanding;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductAttributesController;
use App\Http\Controllers\ProductAttributesValuesController;
use App\Http\Controllers\ProductCategorizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOfferController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\PromoCodePlanController;
use App\Http\Controllers\ScheduledMessagesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Wallet\MerchantWalletController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\MerchantWallet;
use App\Models\Payment as PaymentTable;
use App\Models\Plan;
use App\Models\Subscribe;
use App\Models\Page;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/remove/cache', function () {
    Artisan::call('storage:link');
    // \Artisan::call('config:cache');
    // \Artisan::call('cache:clear');
    // \Artisan::call('config:clear');
    // \Artisan::call('view:clear');
    // \Artisan::call('optimize:clear');
    // \Artisan::call('route:clear');
    // \Artisan::call('route:cache');

});

Route::get('ll', function () {
//    \auth()->loginUsingId(127);
//    \App\Helper\Ws::make(PhoneFormat('+962795802375'), 'tsssest')->send();
    auth()->loginUsingId(888);
//    \App\Helper\Ws::make('+22226440645', 'test')->send();
//     $messages = \App\Helper\Messages::get()->all();
//     if ($messages) {
//         foreach ($messages as $item) {
// //            Queue::later(now()->addSeconds($item['time']), new \App\Jobs\ScheduledMessages(PhoneFormat(PhoneFormat($user->mobile)), $item));
//              ( new \App\Jobs\ScheduledMessages(PhoneFormat("962795802375"), $item))->handle();
//         }
//     }
    return back();
});
Route::get('/pwa', function () {
    return redirect('/dashboard/index');
});
Route::get('.well-known/assetlinks.json', function () {
    header('Content-Type: application/json; charset=utf-8');

//     echo [{
//   "relation": ["delegate_permission/common.handle_all_urls"],
//   "target" : { "namespace": "android_app", "package_name": "com.marssa",
//                "sha256_cert_fingerprints": ["D7:8D:8D:F5:C5:66:C9:68:FA:51:40:B9:1A:03:9A:F3:FC:D3:B6:D4:E2:C1:2D:83:63:E4:D4:1C:3E:C0:81:04"] }
// }];
});

Route::post('/login', function (Request $request) {
    $user = User::where('mobile', 'like', '%' . $request->login)->first();
    if ($user) {
        if (Hash::check($request->password, $user->password)) {
            $arr = [
                'username' => $user->username,
                'password' => $request->password,
            ];
            Auth::attempt($arr);
            if (Auth::check()) {
                return redirect()->route('dashboard.index');
            } else {
                return 'false';
            }
        } else {
            return redirect()->back()->withErrors('errors', 'Invalid Cridetnatils');
        }
    } else {
        return redirect()->back()->withErrors('errors', 'User Not Found');
    }
});

Route::get('/be-affiliater',function(){
    return view('auth.affiliater');
})->name('be-affiliater');

Route::post('/submit-affiliate',[AffilitersMarketPlaceController::class,'create_affiliate'])->name('submit-affiliate');
// Route::post('/login',function(Request $request){
//     return $request->all();
// });


Route::get('pre', function () {
    dd(session('pre'));
});

Route::middleware(['auth', 'check_blocked'])->group(function () {
    Route::get('verify-mobile', [OtpMobileVerifyController::class,'otp_verify_mobile'])->name('verification.verify');
    Route::get('verified/otp-mobile', [OtpMobileVerifyController::class,'otp_verified_mobile']);

});

Route::get('must-upgrade/{section}', function ($section) {
    return view('error-404', ['title_page' => $section, 'section' => $section]);
});
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, PATCH, DELETE');
// header('Access-Control-Allow-Headers: Accept, Content-Type, X-Auth-Token, Origin, Authorization');

Route::group(['domain' => '{sub_domain}.' . env('MAIN_DOMAIN'), 'as' => 'store.', 'middleware' => 'check_store'], function () {

    Route::get('/', [LandingStore::class,'index'])->name('index');
    Route::middleware(['cors'])->group(function () {
        Route::get('/api/getVariants', [LandingStore::class,'getVariants'])->name('getVariants');
    });

    Route::post('cardRender', function () {
        return view("Store.components.cartRender")->render();
    });
    Route::get('/product/detailss/{id}', [LandingStore::class,'product_details'])->name('product_details');

    Route::get('/product-option/{product_id}/{color_id}', [LandingStore::class,'get_product_option']);


    Route::get('/offer/{id}', [NewLanding::class,'show_product'])->name('show_product');
    Route::post('/store_order', [NewLanding::class,'store_order'])->name('store_order');
   // Route::get('/order/{id}', [NewLanding::class,'show_order'])->name('show_order');
    Route::get('/orders/thank_you/{id}', [NewLanding::class,'thank_you'])->name('thank_you');
    Route::get('/category/{id}', [LandingStore::class,'show_category'])->name('show_category');

    Route::get('/product/details/{id}/ads', [LandingStore::class,'product_details'])->name('product_details_ads');
    Route::post('/product/order/{id}', [LandingStore::class,'product_order'])->name('product_order');
    Route::get('/show/{page}', [LandingStore::class,'show_page'])->name('show_page');
    Route::post('tap_payment_post', [PaymentController::class,'tap_payment_post'])->name('tap_payment_post');
    Route::get('cart', [CartController::class,'index'])->name('cart.index');
  //  Route::get('new_cart',[CartController::class,'new_cart'])->name('cart.new');

    Route::post('/add_to_cart', [CartController::class,'Add'])->name('add_to_cart');
    Route::post('/add_offer', [CartController::class,'add_offer'])->name('add_offer');

    Route::post('/remove_from_cart', [CartController::class,'Remove'])->name('remove_from_cart');
    Route::post('/update_cart/{rowId?}', [CartController::class,'Update'])->name('update_cart');
    Route::post('/add_coupon', [CartController::class,'ApplyPromo'])->name('add_coupon');
    Route::post('/remove_coupon', [CartController::class,'RemovePromo'])->name('remove_coupon');
    Route::get('/checkout', [CartController::class,'Checkout'])->name('checkout');
    Route::post('/abandoned_cart', [AbandonedOrdersController::class,'add_to_abandoned_cart'])->name('abandoned_cart');


    Route::get('/final_checkout', [CartController::class,'final_checkout']);

    Route::post('/make_order', [CartController::class,'make_order'])->name('make_order');
    Route::get('/paypal_success', [PayPalController::class,'paypal_success'])->name('paypal_success');
    Route::get('/paypal_failure', [PayPalController::class,'paypal_failure'])->name('paypal_failure');
    Route::get('/thank_you', [CartController::class,'thank_you'])->name('thank_you');
    Route::post('/submit_review/{product_id}', [LandingStore::class,'submit_review'])->name('submit_review');


    // affiliaters marketplace
    Route::get('/marketplace/work-as-affiliter-for-marketplace',[AffilitersMarketPlaceController::class,'create_order_joining'])->name('work_as_affiliter_for_marketplace');
    Route::post('/marketplace/join_as_partner_affiliate',[AffilitersMarketPlaceController::class,'store_order_joininig_as_partner_affiliate'])->name('join_as_partner_affiliate');

    // Front competitons
    Route::get('show-competitions',[FrontCompetitionController::class,'index']);
    Route::get('details-competition/{slug}',[FrontCompetitionController::class,'details_competition'])->name('details_competition');
    Route::post('search-on-competitiors',[FrontCompetitionController::class,'search_on_competitiors'])->name('search-on-competitiors');
    Route::post('join-competition',[FrontCompetitionController::class,'join_competition'])->name('join-competition');

});

Route::group(['domain' => env('MAIN_DOMAIN'), 'as' => 'site.'], function () {
    Route::get('/', [LandingController::class,'index'])->name('index');
    Route::get('reset/password', [WhatsappResetPassword::class,'index'])->name('reset_password');
    Route::post('message/whatsapp', [WhatsappResetPassword::class,'whatsapp_message_handle'])->name('whatsapp_message');
    Route::post('/register', [RegisterController::class,'create'])->name('register');
    Route::get('/verify-mobile', [RegisterController::class,'otp_verify_mobile'])->name('otp-verify');
    // Route::get('/pricing', [LandingController::class,'pricing'])->name('pricing');
    Route::get('/show/{page}', [LandingController::class,'show_page'])->name('show_page');
    Route::get('/category/{id}', [LandingStore::class,'show_category'])->name('show_category');


    Auth::routes(['verify' => true]);

});

Route::middleware(['check_store'])->prefix('')->group(function () {


    Route::get('/', [LandingStore::class,'index'])->name('index');
    Route::get('/product/details/{id}', [LandingStore::class,'product_details'])->name('product_details');

    Route::get('/product-option/{product_id}/{color_id}', [LandingStore::class,'get_product_option']);

    Route::get('/product/details/{id}/ads', [LandingStore::class,'product_details'])->name('product_details_ads');
    Route::post('/product/order/{id}', [LandingStore::class,'product_order'])->name('product_order');
    Route::get('/show/{page}', [LandingStore::class,'show_page'])->name('show_page');
    Route::get('/category/{id}', [LandingStore::class,'show_category'])->name('show_category');
    Route::get('cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/add_to_cart', [CartController::class,'Add'])->name('add_to_cart');
    Route::post('/add_offer', [CartController::class,'add_offer'])->name('add_offer');
    Route::post('/remove_from_cart', [CartController::class,'Remove'])->name('remove_from_cart');
    Route::post('/update_cart/{rowId?}', [CartController::class,'Update'])->name('update_cart');
    Route::post('/add_coupon', [CartController::class,'ApplyPromo'])->name('add_coupon');
    Route::post('/remove_coupon', [CartController::class,'RemovePromo'])->name('remove_coupon');
    Route::get('/checkout', [CartController::class,'Checkout'])->name('checkout');
    Route::get('/final_checkout', [CartController::class,'final_checkout']);
    Route::post('/make_order', [CartController::class,'make_order'])->name('make_order');
    Route::get('/paypal_success', [PayPalController::class,'paypal_success'])->name('paypal_success');
    Route::get('/paypal_failure', [PayPalController::class,'paypal_failure'])->name('paypal_failure');
    Route::get('/thank_you', [CartController::class,'thank_you'])->name('thank_you');
    Route::post('/abandoned_cart', [AbandonedOrdersController::class,'add_to_abandoned_cart'])->name('abandoned_cart');
    Route::post('/submit_review/{product_id}', [LandingStore::class,'submit_review'])->name('submit_review');

});

Route::post('/contact', [LandingController::class,'send_contact_us'])->name('send_contact_us');
Route::get('locale/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('sitemap.xml', function () {
    $pages = Page::all();
    $stores = Store::where('domain', '<>', env('MainDomain'))->whereStatus(1)->get();
    $context = [
        'pages' => $pages,
        'stores' => $stores
    ];
    return response()->view('sitemap', $context)->header('Content-Type', 'text/xml');
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/blocked', [DashboardController::class,'blocked'])->name('blocked');
    Route::post('video_watched', [UserController::class,'video_watched'])->name('video_watched');
    Route::post('steps', [UserController::class,'steps'])->name('steps');
});
Route::middleware(['auth', 'check_blocked'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::middleware(['mobile_verified'])->group(function () {

        Route::get('/index', [DashboardController::class,'index'])->name('index');
        Route::get('/profile', [UserController::class,'profile'])->name('profile');
        Route::post('profile', [UserController::class,'store'])->name('profile_store');
        Route::get('/visitors', [VisitorsController::class,'index'])->name('visitors');


        Route::get('/links',[DashboardController::class,'links_index'])->name('links');
        Route::post('/links-store',[DashboardController::class,'links_add'])->name('store-link');
        Route::post('/links-update/{id}',[DashboardController::class,'links_update'])->name('links-update');
        Route::get('/links-delete/{id}',[DashboardController::class,'links_destroy'])->name('links_destroy');

        Route::get('/choose-package/{packageName}', function($packageName){
            return view('dashboard.package.package')->with(['packageName'=>$packageName, 'plans' => Plan::all(),'user_plan'=>auth()->user()->store()->first()->plan->first(),'title_page'=>'packages']);
        })->name('choose-dashboard');

        Route::get('/check-function/{store_id}',[StoreController::class,'check_7th_days']);
        // Route All Admin & User
        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
            Route::prefix('slider')->name('slider.')->group(function () {
                Route::get('/', [SliderController::class,'slider'])->name('index');
                Route::get('/add', [SliderController::class,'add'])->name('add_slider');
                Route::get('/edit/{id}', [SliderController::class,'edit'])->name('edit_slider');
                Route::post('/save', [SliderController::class,'save_image'])->name('save_slider');
                Route::post('/edit', [SliderController::class,'update'])->name('update_slider');
                Route::get('/delete/{id}', [SliderController::class,'delete'])->name('delete_slider');
            });


            Route::prefix('color')->name('color.')->group(function () {
                Route::get('/', [ColorController::class,'color'])->name('index');
                Route::get('/add', [ColorController::class,'add'])->name('add_color');
                Route::get('/edit/{id}', [ColorController::class,'edit'])->name('edit_color');
                Route::post('/save', [ColorController::class,'save'])->name('save_color');
                Route::post('/edit', [ColorController::class,'update'])->name('update_color');
                Route::get('/delete/{id}', [ColorController::class,'delete'])->name('delete_color');

            });

            Route::middleware(['plan_rules:products'])->prefix('products')->name('products.')->group(function () {
                Route::get('/', [ProductController::class,'index'])->name('index');
            });
            Route::middleware(['plan_rules:orders'])->prefix('orders')->name('orders.')->group(function () {
                Route::get('/', [OrderController::class,'index'])->name('index');
                Route::get('/canceled/{store_id}', [OrderController::class,'canceledOrders'])->name('canceledOrders');
                Route::get('/details/{id}', [OrderController::class,'order_details'])->name('order_details');
                Route::get('/abandoned-orders',[AbandonedOrdersController::class,'index'])->name('abandoned_orders');
                Route::delete('/abandoned-orders/{order}',[AbandonedOrdersController::class,'destroy'])->name('abandoned_orders.delete');
                Route::get('/abandoned-order-show/{order}',[AbandonedOrdersController::class,'show'])->name('abandoned_order_show');
            });

            Route::get('/offers', [OfferController::class,'index'])->name('offers')->middleware('plan_rules:market');
            Route::get('/promo_codes', [PromoCodeController::class,'index'])->name('promo_codes')->middleware('plan_rules:coupons');
            Route::get('/Reviews', [ProductReviewsController::class,'index'])->name('Reviews')->middleware('plan_rules:reviews');
            Route::get('/reports', [ExportDataController::class,'reports'])->name('reports')->middleware('plan_rules:statics');
            Route::get('/reports/stores', [ExportDataController::class,'reportsStores'])->name('reportsStores')->middleware('role:SuperAdmin');
            Route::get('/clients', [ClientController::class,'index'])->name('clients')->middleware('plan_rules:clients');

            Route::get('/upsell', [OfferController::class,'upsell'])->name('upsell')->middleware('plan_rules:market');


        });

        // Route User, SubUser
        Route::middleware(['role:User|SubUser'])->prefix('admin')->name('admin.')->group(function () {

            Route::prefix('target')->name('target.')->group(function () {
                Route::get('/show', [StoreController::class,'add_target'])->name('show-target');
                Route::post('/re-target', [StoreController::class,'re_target'])->name('add-target');
            });


            Route::get('/explanations', [ExplanationController::class,'index'])->name('explanations-index');

            Route::middleware(['plan_rules:products'])->prefix('products')->name('products.')->group(function () {
                Route::prefix('attributes')->name('attributes.')->group(function () {
                    Route::get('/', [ProductAttributesController::class,'index'])->name('index');
                    Route::get('/create', [ProductAttributesController::class,'create'])->name('add');
                    Route::post('/store', [ProductAttributesController::class,'store'])->name('store');
                    Route::get('/{id}/edit', [ProductAttributesController::class,'edit'])->name('edit');
                    Route::put('/{id}/update', [ProductAttributesController::class,'update'])->name('update');
                    Route::get('/{id}/changeStatus',[ProductAttributesController::class,'changeStatus'])->name('changeStatus');
                     Route::prefix('values')->name('values.')->group(function () {
                    Route::get('/', [ProductAttributesValuesController::class,'index'])->name('index');
                    Route::get('/create', [ProductAttributesValuesController::class,'create'])->name('add');
                    Route::post('/store', [ProductAttributesValuesController::class,'store'])->name('store');
                    Route::get('/{id}/edit', [ProductAttributesValuesController::class,'edit'])->name('edit');
                    Route::put('/{id}/update', [ProductAttributesValuesController::class,'update'])->name('update');
                });
                });
                Route::get('/products_index', [ProductController::class,'products_index'])->name('products_index');
                Route::get('/getValues', [ProductController::class,'getValues'])->name('get_values');
                Route::get('/add', [ProductController::class,'add'])->name('add');
                Route::get('/add', [ProductController::class,'add'])->name('add');
                Route::post('/add', [ProductController::class,'product_add'])->name('add');
                Route::get('/edit/{id}', [ProductController::class,'product_edit'])->name('edit');
                Route::post('/update/{id}', [ProductController::class,'product_update'])->name('update');
                Route::post('/product_featured_image', [ProductController::class,'product_featured_image'])->name('featured_image');
                Route::post('/product_saveFile', [ProductController::class,'saveFile'])->name('saveFile');
                Route::post('/product_remove_image', [ProductController::class,'product_remove_image'])->name('remove_image');
                Route::get('/delete/{id}', [ProductController::class,'product_delete'])->name('delete');
                Route::get('/delete-product-option/{id}', [ProductController::class,'product_option_delete'])->name('delete_product_option');
                Route::get('/get-colors', [ProductController::class,'get_colors']);

            });

            Route::prefix('offers')->name('offers.')->group(function () {
                Route::get('/add', [OfferController::class,'add'])->name('add');
                Route::post('/add', [OfferController::class,'offer_add'])->name('add');
                Route::get('/edit/{id}', [OfferController::class,'offer_edit'])->name('edit');
                Route::post('/update/{id}', [OfferController::class,'offer_update'])->name('update');
                Route::get('/delete/{id}', [OfferController::class,'offer_delete'])->name('delete');
            });



            Route::prefix('upsell')->name('upsell.')->group(function () {
                Route::get('/add', [OfferController::class,'add_upsell'])->name('add');
                Route::post('/add', [OfferController::class,'store_upsell'])->name('add');
                Route::get('/edit/{id}', [OfferController::class,'upsell_edit'])->name('edit');
                Route::post('/update/{id}', [OfferController::class,'upsell_update'])->name('update');
                Route::get('/delete/{id}', [OfferController::class,'upsell_delete'])->name('delete');
            });


            Route::middleware(['plan_rules:coupons'])->prefix('promo_codes')->name('promo_codes.')->group(function () {
                Route::get('/add', [PromoCodeController::class,'add'])->name('add');
                Route::post('/add', [PromoCodeController::class,'promo_code_add'])->name('add');
                Route::get('/edit/{id}', [PromoCodeController::class,'promo_code_edit'])->name('edit');
                Route::post('/update/{id}', [PromoCodeController::class,'promo_code_update'])->name('update');
                Route::get('/delete/{id}', [PromoCodeController::class,'promo_code_delete'])->name('delete');
            });

            Route::middleware(['plan_rules:reviews'])->prefix('Reviews')->name('Reviews.')->group(function () {
                Route::get('/add', [ProductReviewsController::class,'create'])->name('add');
                Route::post('/add', [ProductReviewsController::class,'store'])->name('add');
                Route::get('/edit/{productReview}', [ProductReviewsController::class,'edit'])->name('edit');
                Route::post('/update/{productReview}', [ProductReviewsController::class,'update'])->name('update');
                Route::get('/delete/{productReview}', [ProductReviewsController::class,'destroy'])->name('delete');
            });

            Route::prefix('categorize')->name('categorize.')->group(function () {
                Route::get('/', [ProductCategorizeController::class,'index'])->name('index');
                Route::get('/add', [ProductCategorizeController::class,'create'])->name('add');
                Route::post('/add', [ProductCategorizeController::class,'store'])->name('add');
                Route::get('/edit/{id}', [ProductCategorizeController::class,'edit'])->name('edit');
                Route::post('/update/{id}', [ProductCategorizeController::class,'update'])->name('update');
                Route::get('/delete/{id}', [ProductCategorizeController::class,'destroy'])->name('delete');
            });

            Route::middleware(['plan_rules:orders'])->prefix('orders')->name('orders.')->group(function () {
                Route::post('/update/{id}', [OrderController::class,'order_update'])->name('order_update');
            });
            Route::post('/update_order_status/{orderPayment}', [OrderPaymentsController::class,'update'])->name('update_order_status')->middleware('plan_rules:orders');
            Route::get('/packagee/{id}', [PlanController::class,'package'])->name('package');


            Route::prefix('payment')->name('payment.')->group(function () {
                Route::post('/check_promo/{id}', [PaymentController::class,'check_promo'])->name('check_promo');
                Route::post('/check_subscription_term/{id}', [PaymentController::class,'check_subscription_term'])->name('check_subscription_term');

                Route::post('/pending/{id}', [PaymentController::class,'pending'])->name('pending');
                Route::post('/free', [PaymentController::class,'free'])->name('free');

                # Route::post('/tap_payment', [PaymentController::class,'tap_payment'])->name('tap_payment');
                # Route::get('/tap_payment_redirect', [PaymentController::class,'tap_payment_redirect'])->name('tap_payment_redirect');

                # Route::post('/paypal', [PaymentController::class,'paypal'])->name('paypal');
                # Route::get('/paypal_success', [PaymentController::class,'paypal_success'])->name('paypal_success');
                # Route::get('/paypal_failure', [PaymentController::class,'paypal_failure'])->name('paypal_failure');

                Route::post('/subscription/package', [PaymentController::class,'subscription_package'])->name('subscription_package');

                Route::post('/transfers', [PaymentController::class,'transfers'])->name('transfers');
            });


            Route::get('merchant-tools', [CalculationsController::class,'merchant_tools'])->name('merchant-tools');
            Route::get('cal-cost-estimation', [CalculationsController::class,'cost_estimation'])->name('cal-cost-estimation');
            Route::post('result-cost-estimation', [CalculationsController::class,'result_cost_estimation'])->name('result-cost-estimation');
            Route::get('cal-growth-rate', [CalculationsController::class,'growth_rate'])->name('cal-growth-rate');
            Route::post('result-growth-rate', [CalculationsController::class,'result_growth_rate'])->name('result-growth-rate');


        });
        Route::middleware(['role:SuperAdmin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('analyze', [AdminAnalyze::class,'index'])->name('analyze');
            Route::get('analyze/stores', [AdminAnalyze::class,'stores'])->name('analyze.stores');
            Route::get('analyze/platform', [AdminAnalyze::class,'platform'])->name('analyze.platform');
        });
        // Route Super Admin, Admin, User
        Route::middleware(['role:SuperAdmin|Admin|User'])->prefix('admin')->name('admin.')->group(function () {
            Route::prefix('participants')->name('participants.')->group(function () {
                Route::get('/', [DashboardController::class,'participants'])->name('index');
            });




            Route::prefix('invoices')->name('invoices.')->group(function () {
                Route::get('/', [InvoicesController::class,'index'])->name('index');
            });

        });

        Route::middleware(['role:SuperAdmin|User'])->prefix('admin')->name('admin.')->group(function () {
            Route::prefix('pages')->name('pages.')->group(function () {
                Route::get('/add', [PageController::class,'add'])->name('add');
                Route::get('/edit/{id}', [PageController::class,'add'])->name('edit');
                Route::post('/store', [PageController::class,'register'])->name('store');
                Route::post('/update/{id}', [PageController::class,'update'])->name('update');
                Route::get('/delete/{id}', [PageController::class,'delete'])->name('delete');
            });
            Route::prefix('store_settings')->name('store_settings.')->group(function () {
                Route::get('/sub_page', [AdvancedController::class,'sub_page'])->name('pages');
            });
        });

        // Route Super Admin, Admin
        Route::middleware(['role:SuperAdmin|Admin'])->prefix('admin')->name('admin.')->group(function () {

            Route::get('/stores/indebtedness', [StoreController::class,'getStoresInd'])->name('max_indebtedness');
            Route::get('/stores', [StoreController::class,'index'])->name('stores');
            Route::get('/stores-update/{id}',[StoreController::class,'updateIndView'])->name('updateIndView');
            Route::post('/stores-update-ind',[StoreController::class,'updateStoresInd'])->name('update-stores-ind');
            Route::put('/reset/password/{participant_id}', [StoreController::class,'reset_password_participants'])->name('reset_password');

            Route::prefix('plans')->name('plans.')->group(function () {
                Route::get('/', [PlanController::class,'index'])->name('index');
                Route::get('/edit/{id}', [PlanController::class,'plan_edit'])->name('edit');
                Route::post('/update/{id}', [PlanController::class,'plan_update'])->name('update');
                Route::post('/update-permission/{id}', [PlanController::class,'permission_update'])->name('permissions');
                Route::post('/design/{id}', [PlanController::class,'plan_design'])->name('plan_design');
                Route::get('/promo_codes', [PromoCodePlanController::class,'promo_codes'])->name('promo_codes');
                Route::prefix('promo_codes')->name('promo_codes.')->group(function () {
                    Route::post('/add', [PromoCodePlanController::class,'add'])->name('add');
                    Route::get('/edit/{id}', [PromoCodePlanController::class,'edit'])->name('edit');
                    Route::post('/update/{id}', [PromoCodePlanController::class,'update'])->name('update');
                    Route::get('/delete/{id}', [PromoCodePlanController::class,'delete'])->name('delete');
                });
            });

            Route::prefix('subscriptions')->name('subscriptions.')->group(function () {
                Route::get('/', [SubscribeController::class,'index'])->name('index');
                Route::post('/register', [SubscribeController::class,'register'])->name('register');
                Route::get('/edit/{id}', [SubscribeController::class,'edit'])->name('edit');
                Route::post('/update', [SubscribeController::class,'update'])->name('update');
            });

            Route::prefix('invoices')->name('invoices.')->group(function () {
                Route::get('/edit/{id}', [InvoicesController::class,'edit'])->name('edit');
                Route::post('/update', [InvoicesController::class,'update'])->name('update');
            });

        });

        // Route User
        Route::middleware(['role:User'])->prefix('admin')->name('admin.')->group(function () {
        //    Route::get('/stores', [StoreController::class,'index'])->name('stores');
          //  Route::put('/reset/password/{participant_id}', [StoreController::class,'reset_password_participants'])->name('reset_password');

            Route::post('/reSubscribeTrail', [SubscribeController::class,'reSubscribeTrial'])->name('reSubscribeTrial');
            /*
            Route::prefix('domains')->name('domains.')->group(function () {
                //Route::post('/subdomain', [CustomDomainController::class,'subdomain'])->name('subdomain');
                ///Route::post('/customdomain', [CustomDomainController::class,'customdomain'])->name('customdomain');
            });*/
        });

        Route::middleware(['role:SuperAdmin|User'])->prefix('admin')->name('admin.')->group(function () {
            Route::prefix('domains')->name('domains.')->group(function () {
                Route::post('/subdomain', [CustomDomainController::class,'subdomain'])->name('subdomain');
                Route::post('/customdomain', [CustomDomainController::class,'customdomain'])->name('customdomain');
            });
            Route::prefix('landing_pages')->name('landing_pages.')->group(function () {
                Route::get('/', [ProductOfferController::class,'index'])->name('index');
                Route::get('/create', [ProductOfferController::class,'create'])->name('create');
                Route::post('/', [ProductOfferController::class,'store'])->name('store');
                Route::get('/{id}/edit', [ProductOfferController::class,'edit'])->name('edit');
                Route::put('/{id}', [ProductOfferController::class,'update'])->name('update');
                Route::get('/destroy/{id}', [ProductOfferController::class,'destroy'])->name('destroy');
                Route::post('/featured_image', [ProductOfferController::class,'featured_image'])->name('featured_image');
                Route::post('/remove_featured_image', [ProductOfferController::class,'remove_featured_image'])->name('remove_featured_image');
                Route::post('/saveFile', [ProductOfferController::class,'saveFile'])->name('saveFile');
                Route::post('/remove_image', [ProductOfferController::class,'remove_image'])->name('remove_image');
                Route::get('/orders/', [ProductOfferController::class,'orders'])->name('orders');
                Route::put('orders/{id}/changeStatus', [ProductOfferController::class,'order_changeStatus'])->name('orders.changeStatus');
                Route::get('orders/{id}', [ProductOfferController::class,'show_order'])->name('orders.show');
            });

            Route::prefix('store_settings')->name('store_settings.')->group(function () {
                Route::get('/', [AdvancedController::class,'index'])->name('index');
                Route::get('/basic_settings', [AdvancedController::class,'basic_settings'])->name('basic_settings');
                Route::get('/domain_settings', [AdvancedController::class,'domain_settings'])->name('domain_settings')->middleware(['plan_rules:subdomain']);
                Route::get('/linking_services', [AdvancedController::class,'linking_services'])->name('linking_services')->middleware(['plan_rules:social-media']);
                Route::get('/seo', [AdvancedController::class,'seo'])->name('seo');
                Route::get('/store_staff', [AdvancedController::class,'store_staff'])->name('store_staff')->middleware('plan_rules:make-roles');
                Route::get('/account_control', [AdvancedController::class,'account_control'])->name('account_control');
                Route::get('/store_design', [AdvancedController::class,'store_design'])->name('store_design');
                Route::post('/store_design/chosen', [AdvancedController::class,'design_chosen'])->name('design_chosen');
                Route::get('/store_payment', [AdvancedController::class,'store_payment'])->name('store_payment');
                Route::get('/upgrade_plan', [PlanController::class,'upgrade_plan'])->name('upgrade_plan');
                Route::post('/upgrade_plan', [PlanController::class,'upgrade_now'])->name('upgrade_plan');
                Route::resource('/branches', BranchesController::class);
                Route::get('/branches/{id}/report', [ExportDataController::class,'branch_report']);

            });

            Route::prefix('administrator')->name('administrator.')->group(function () {
                Route::post('/register', [AdminController::class,'register'])->name('register');
                Route::get('/edit/{id}', [AdminController::class,'admin_edit'])->name('admin_edit');
                Route::post('/update', [AdminController::class,'update'])->name('update');
                Route::get('/delete/{id}', [AdminController::class,'admin_delete'])->name('delete');
            });

            Route::prefix('information')->name('information.')->group(function () {
                Route::post('/store', [InformationController::class,'store'])->name('store');
                Route::post('/whatsapp', [InformationController::class,'whatsapp'])->name('whatsapp')->middleware(['role:SuperAdmin']);
                Route::post('/notes', [InformationController::class,'notes'])->name('notes');
            });
            Route::prefix('information')->name('information.')->group(function () {
                Route::post('/remove', [InformationController::class,'remove'])->name('remove');
            });

            Route::prefix('export')->name('export.')->group(function () {
                Route::get('/data/{table}/{branch_id?}', [ExportDataController::class,'export_data'])->name('data');
            });
        });

        // Route SuperAdmin
        Route::middleware(['role:SuperAdmin'])->prefix('admin')->name('admin.')->group(function () {

            Route::prefix('store_settings')->name('store_settings.')->group(function () {
                Route::get('/models_stores', [AdvancedController::class,'models_stores'])->name('models_stores');
                Route::get('/features_platform', [AdvancedController::class,'features_platform'])->name('features_platform');
                Route::resource('/explanations', ExplanationController::class)->except(['index', 'show']);
                Route::post('/sendWhatsApp', [ScheduledMessagesController::class,'whatsapp'])->name('send.whatsapp');
                Route::resource('/scheduled_messages', ScheduledMessagesController::class);
            });


            Route::prefix('domains')->name('domains.')->group(function () {
                Route::get('/requests', [CustomDomainController::class,'requests'])->name('requests');
                Route::get('/requests/{id}', [CustomDomainController::class,'change_requests'])->name('change_requests');
            });

            Route::prefix('models')->name('models.')->group(function () {
                Route::get('/add', [ModelsController::class,'add'])->name('add');
                Route::get('/edit/{id}', [ModelsController::class,'add'])->name('edit');
                Route::post('/store', [ModelsController::class,'register'])->name('store');
                Route::post('/update/{id}', [ModelsController::class,'update'])->name('update');
                Route::get('/delete/{id}', [ModelsController::class,'delete'])->name('delete');
            });

            Route::prefix('features')->name('features.')->group(function () {
                Route::get('/add', [FeaturesController::class,'add'])->name('add');
                Route::get('/edit/{id}', [FeaturesController::class,'add'])->name('edit');
                Route::post('/store', [FeaturesController::class,'register'])->name('store');
                Route::post('/update/{id}', [FeaturesController::class,'update'])->name('update');
                Route::get('/delete/{id}', [FeaturesController::class,'delete'])->name('delete');
            });

            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', [UserController::class,'index'])->name('index');
                Route::post('/register', [UserController::class,'user_add'])->name('register');
                Route::get('/edit/{id}', [UserController::class,'user_edit'])->name('user_edit');
                Route::post('/update', [UserController::class,'user_update'])->name('update');
                Route::get('/delete/{id}', [UserController::class,'user_delete'])->name('delete');
            });

            Route::prefix('section')->name('section.')->group(function () {
                Route::post('/store/{type}', [SectionController::class,'store'])->name('store');
            });

            Route::prefix('contacts')->name('contacts.')->group(function () {
                Route::get('/', [ContactController::class,'index'])->name('index');
                Route::get('/details/{id}', [ContactController::class,'details'])->name('details');
                Route::post('/send', [ContactController::class,'send'])->name('send');
            });

            Route::prefix('counters')->name('counters.')->group(function () {
                Route::get('/', [CounterController::class,'index'])->name('index');
                Route::post('/store', [CounterController::class,'store'])->name('store');
                Route::post('/upload', [CounterController::class,'upload'])->name('upload');
            });

            Route::prefix('feedback')->name('feedback.')->group(function () {
                Route::get('/', [FeedbackController::class,'index'])->name('index');
                Route::get('/add', [FeedbackController::class,'add'])->name('add');
                Route::get('/edit/{id}', [FeedbackController::class,'add'])->name('edit');
                Route::post('/store', [FeedbackController::class,'register'])->name('store');
                Route::post('/update/{id}', [FeedbackController::class,'update'])->name('update');
                Route::post('/delete', [FeedbackController::class,'delete'])->name('delete');
                Route::post('/upload', [FeedbackController::class,'upload'])->name('upload');
            });

        });


        /* Route User, SubUser*/
        Route::middleware(['role:User|SubUser'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('wallet', [MerchantWalletController::class,'show_wallet'])->name('wallet');
            Route::get('pay_commission', [MerchantWalletController::class,'pay_commission'])->name('pay_commission');
            Route::get('pay_commission_automatically',[MerchantWalletController::class,'pay_commission_auto'])->name('pay_commission_auto');
            Route::post('add-wallet', [MerchantWalletController::class,'add_balance_in_wallet'])->name('add_balance_wallet');
            Route::get('/paypal_success', [MerchantWalletController::class,'paypal_success'])->name('wallet_paypal_success');
             Route::get('/paypal_success', [MerchantWalletController::class,'paypal_success_v2'])->name('wallet_paypal_success_v2');
            Route::get('/paypal_failure', [MerchantWalletController::class,'paypal_failure'])->name('wallet_paypal_failure');
        });

        Route::middleware(['role:SuperAdmin|Admin|User'])->prefix('admin')->name('admin.')->group(function () {

            Route::get('wallet-orders', [MerchantWalletController::class,'wallet_orders'])->name('wallet-orders');
            Route::get('wallet-manual-charge', [MerchantWalletController::class,'recharge'])->name('wallet-recharge');
            Route::post('wallet-manual-charge', [MerchantWalletController::class,'save_recharge'])->name('wallet-recharge');
            Route::get('wallet-charge-order-edit/{id}', [MerchantWalletController::class,'wallet_charge_order_edit'])->name('wallet-charge-order-edit');
            Route::post('wallet-update', [MerchantWalletController::class,'wallet_charge_order_update'])->name('wallet-update');

        });


        // Route User, SubUser Affiliates
        Route::middleware(['role:User|SubUser'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('affiliate_index',[AffiliateController::class,'affiliate_index'])->name('affiliate_index');
            Route::get('affiliates/create',[AffiliateController::class,'create_affiliate'])->name('affiliates-create');
            Route::post('affiliates/store',[AffiliateController::class,'store_affiliate'])->name('affiliates-store');
            Route::get('affiliatees/show',[AffiliateController::class,'show_affiliatees'])->name('affiliatees-show');

            Route::get('affiliatees/my-profits',[AffiliateController::class,'my_profit_affiliatees'])->name('affiliatees-my-profits');
            Route::post('affiliatees/order-withdraw',[AffiliateController::class,'order_withdraw_affiliatees'])->name('affiliatees-order-withdraw');
            Route::get('affiliatees/withdraws',[AffiliateController::class,'affiliater_withdraws'])->name('affiliatees-withdraw');
            Route::post('affiliatees/send-invitation',[AffiliateController::class,'send_invitation_email'])->name('affiliatees-send-invitation');
            Route::post('affiliatees/send-wahtsapp-invitation',[AffiliateController::class,'send_message_whatsapp_invitation'])->name('affiliatees-send-message-whatsapp');

            // affiliate marketPlace
            Route::get('marketplace/affiliates/create',[AffiliateMarketPlaceController::class,'marketplace_affiliates_create'])->name('marketplace-affiliates-create');
            Route::post('marketplace/affiliates/store',[AffiliateMarketPlaceController::class,'marketplace_affiliates_store'])->name('marketplace-affiliates-store');
            Route::get('marketplace/affiliaters/show',[AffiliateMarketPlaceController::class,'marketplace_affiliaters_show'])->name('marketplace-affiliaters-show');
            Route::get('marketplace/affiliates/order/status/{affiliate_id}/{status}',[AffiliateMarketPlaceController::class,'marketplace_affiliate_order_status']);

        });


        // Route Admin, SuperAdmin Affiliates
        Route::middleware(['role:SuperAdmin|Admin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('affiliaters',[affiliatersController::class,'show_affiliaters'])->name('affiliaters');
            Route::get('affiliates-profites',[affiliatersController::class,'profites_affiliaters'])->name('affiliates-profites');
            Route::get('affiliates-withdraw-profites',[affiliatersController::class,'affiliaters_withdraw_profits'])->name('affiliates-withdraw-profites');
            Route::get('affiliater/{user}',[affiliatersController::class,'show_affiliater_details']);
            Route::post('affiliate-order-withdraw-update/{order_id}',[affiliatersController::class,'change_status'])->name('affiliate-order-withdraw-update');
            Route::get('withdraw-affiliate-order/{order}',[affiliatersController::class,'show_withdraw_order']);
            Route::post('update-status-affiliate-rate/{user}',[affiliatersController::class,'update_status_affiliate_rate'])->name('update-status-affiliate-rate');

        });

        // Route User, SubUser Competions
        Route::middleware(['role:User|SubUser'])->name('merchant.')->group(function () {
            Route::resource('competitions',CompetitionController::class);
            Route::post('competitions/saveMedia',[CompetitionController::class,'saveMedia'])->name('competition_saveMedia');
            Route::post('competition/remove-media',[CompetitionController::class,'removeMedia'])->name('remove_competition_media');
            Route::post('competition-order-attach-customer/{order_id}',[CompetitionController::class,'competition_order_attach_customer'])->name('competition_order_attach_customer');
            Route::get('competitors-show/{competition_id}',[CompetitionController::class,'competitors_show'])->name('competitors_show');
            Route::post('competitions/choice-winner/{competition_id}',[CompetitionController::class,'choice_winner'])->name('competition_choice_winner');
            // Route::post('affiliates/store',[AffiliateController::class,'store_affiliate'])->name('affiliates-store');
            // Route::get('affiliatees/show',[AffiliateController::class,'show_affiliatees'])->name('affiliatees-show');
        });

        //Muhammed Fawzy 12-3-2023
            // Route::prefix('Competition')->name('Competition.')->group(function () {
            //     Route::get('/index', [CompetitionController::class,'index'])->name('comp-index');
            //     Route::get('/create', [CompetitionController::class,'create'])->name('comp-create');
            //     Route::post('/store', [CompetitionController::class,'store'])->name('comp-store');
            //     Route::get('/edit/{id}', [CompetitionController::class,'edit'])->name('comp-edit');
            //     Route::post('/update', [CompetitionController::class,'update'])->name('comp-update');
            //     Route::get('/delete/{id}', [CompetitionController::class,'destroy'])->name('comp-delete');
            // });
    });





});


Route::get('command-console',function(){
    Artisan::call('vendor:publish --tag=datatables');
});

# here show video explanantion to all members who request it
Route::prefix('video')->name('video.')->group(function () {
    Route::get('/explanations/{section}', [ExplanationController::class,'show']);
});


Route::get('complete-shopping/{order}',[AbandonedOrdersController::class,'regenerate_cart'])->name('regenerate_cart_items');