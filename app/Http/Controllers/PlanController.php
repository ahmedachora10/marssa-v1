<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Plan;
use App\CustomDomain;
use App\Payment;
use App\Design;
use App\DesignPlan;
use App\Subscribe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $plans = Plan::all();
        $title_page = 'packages';
        return view('dashboard.plans', ['title_page' => $title_page, 'plans' => $plans]);
    }

    public function package($id)
    {
        
        $plan = Plan::whereId($id)->first();
        
        if (!$plan) {
            return redirect(route('dashboard.admin.plans.index'));
        }
        $auth_user = auth()->user();
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();
        $pending_payment = $auth_user->payments()->whereStatus(0)->orderBy('id', 'desc')->first();

        $upgrade_plan_route = route('dashboard.admin.store_settings.upgrade_plan');
        $upgrade_plan_status = $upgrade_plan_route == back()->getTargetUrl();
        
        $user_plan = $auth_user->store()->first()->plan()->first();
        if (!$user_plan and $upgrade_plan_status) {
            $upgrade_plan_status = false;
        }

        $context = [
            'title_page' => 'plan_details',
            'plan' => $plan,
            'current_plan' => $user_plan,
            'information' => $information,
            'pending_payment' => $pending_payment,
            'upgrade_plan_status' => $upgrade_plan_status,
        ];

        if ($upgrade_plan_status) {
            if (Carbon::parse($user_plan->deadline) >= now() and $user_plan->price > 0 and $plan->price == 0) {
                return redirect()->back();
            }
            $user_subscriptions = $auth_user->getCurrentSubscriptions();
            $context['subscriptions'] = $user_subscriptions;
        }
        return view('dashboard.plan_details', $context);
    }

    public function plan_edit($id)
    {
        $designs = Design::all();
        $plan = Plan::whereId($id)->first();
        if (!$plan) {
            return redirect(route('dashboard.admin.plans.index'));
        }
        $context = [
            'title_page' => 'plan_edit',
            'plan' => $plan,
            'designs' => $designs,
        ];
        return view('dashboard.plan_edit', $context);
    }
    
    public function permission_update($id, Request $request){
        Plan::whereId($id)->update(['permissions'=>json_encode( $request->input('PlanPermission') )]);
        return back();
    }

    public function plan_design($id, Request $request)
    {
        $plan = Plan::whereId($id)->first();
        if (!$plan) {
            return redirect(route('dashboard.admin.plans.index'));
        }
        DesignPlan::where('plan_id', $id)->update(['status' => 0]);
        $designs = $request->all()['design'] ?? [];
        foreach ($designs as $design) {
            $design = Design::whereId($design)->first();
            if ($design) {
                $obj = DesignPlan::where('plan_id', $id)->where('design_id', $design->id)->first();
                if ($obj) {
                    $obj->update(['status' => 1]);
                } else {
                    $design_plan = new DesignPlan();
                    $design_plan['status'] = true;
                    $design_plan->plan()->associate($plan);
                    $design_plan->design()->associate($design);
                    $design_plan->save();
                }
            }
        }
        return redirect()->back();
    }

    public function plan_update($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'name_fr' => ['required', 'string', 'max:255'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'language' => ['nullable', 'boolean'],
            'ssl' => ['nullable', 'boolean'],
            'integration' => ['nullable', 'boolean'],
            'custom_domain' => ['nullable', 'boolean'],
            'custom_design' => ['nullable', 'boolean'],
            'price' => ['required', 'string'],
            'offer_count' => ['required', 'string'],
            'order_count' => ['required', 'string'],
            'users_count' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $plan = Plan::whereId($id)->first();
        if (!$plan) {
            return redirect(route('dashboard.admin.plans.index'));
        }
        $plan->update([
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'name_fr' => $data['name_fr'],
            'description_fr' => $data['description_fr'],
            'description_ar' => $data['description_ar'],
            'description_en' => $data['description_en'],
            'price' => $data['price'],
            'offer_count' => $data['offer_count'],
            'order_count' => $data['order_count'],
            'users_count' => $data['users_count'],
            'language' => $data['language'] ?? false,
            'ssl' => $data['ssl'] ?? false,
            'integration' => $data['integration'] ?? false,
            'custom_domain' => $data['custom_domain'] ?? false,
            'custom_design' => $data['custom_design'] ?? false,
        ]);

        if (!array_key_exists("custom_design", $data)) {
            $designs = $plan->DesignPlan()->where('status', true);
            $designs->update(['status' => false]);
        }

        if (!array_key_exists("integration", $data)) {
            $stores = $plan->stores()->get();
            foreach ($stores as $store) {
                $store->information()->update(['facebook_pixel_id' => null, 'google_tag_manager' => null]);
            }
        }
        return redirect()->back();
    }

    public function upgrade_plan()
    {
        
        $auth_user = auth()->user();
        $user_plan = $auth_user->store()->first()->plan()->first();
        if ($user_plan) {
            $current = $auth_user->getCurrentSubscriptions();
            $previous_upgrade = $auth_user->store()->first()->subscribes()->wherePay('Upgrade')->orderBy('id', 'desc')->paginate(12);
            $context = [
                'user_plan' => $user_plan,
                'title_page' => 'upgrade_plan',
                'previous_upgrade' => $previous_upgrade,
                'plans' => Plan::all(),
                'deadline' => $current ? $current->deadline : false,
                'plan' => $user_plan,
            ];
            return view('dashboard.upgrade_plan', $context);
        } else {
            return redirect()->back()->with('error', 'null_user_plan');
        }

    }

    public function upgrade_now(Request $request)
    {
        
        //return $request->all();
        $id = $request->all()['id'];
        $plan = Plan::whereId($id)->first();
        $auth_user = auth()->user();
        $user_store = $auth_user->store()->first();
        $current_plan = $user_store->plan()->first();
        if (!$plan or $current_plan->id == $id) {
            return redirect()->back();
        }
        $user_subscriptions = $auth_user->getCurrentSubscriptions();
        $new_deadline = $user_subscriptions->DeadlineForNewSubscription($id);

        if ($current_plan->integration and !$plan->integration) {
            $user_store->information->update(['facebook_pixel_id' => null, 'google_tag_manager' => null]);
        }
        if ($current_plan->language == 1 and $plan->language == 0) {
            if ($user_store->language == 2) {
                $user_store->update(['language' => 0]);
            }
        }
        if ($current_plan->custom_domain and !$plan->custom_domain) {
            $user_store->update(['new_domain' => null]);
            CustomDomain::whereStore_id($user_store->id)->update(['status' => false]);
        }
        if ($current_plan->custom_design and !$plan->custom_design) {
            $user_store->update(['design' => null]);
        }
        if ($current_plan->offer_count > $plan->offer_count) {
            $user_store->offers()->update(['status' => false]);
        }
        if ($current_plan->users_count > $plan->users_count) {
            $user_store->users()->where('id', '<>', $auth_user->id)->update(['status' => false]);
        }

        $subscribe = new Subscribe();
        $subscribe['deadline'] = $new_deadline;
        $subscribe['pay'] = 'Upgrade';
        $subscribe->store()->associate($user_store);
        $subscribe->plan()->associate($plan);

        $status = $subscribe->deadline > now();
        if ($subscribe->save()) {
            Subscribe::whereStore_id($user_store->id)->update(['status' => false]);
            $subscribe->update(['status' => $status]);
            $user_store->update(['status' => $status, 'plan_id' => $plan->id]);
        };
        return redirect(route('dashboard.admin.store_settings.upgrade_plan'));
    }
}
//Developed Saed Z. Sinwar
