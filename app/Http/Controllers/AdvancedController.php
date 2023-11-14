<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Http\Request;
use App\Page;
use App\Models;
use App\Section;
use App\Design;
use App\DesignPlan;

class AdvancedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title_page = 'store_settings';
        return view('dashboard.store_settings', ['title_page' => $title_page]);
    }

    public function basic_settings()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $information = $store->information()->first();

        if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        else
            $language = ['ar', 'en', 'fr'];

        $context = [
            'title_page' => 'basic_settings',
            'language' => $language,
            'store' => $store,
            'plan' => $store->plan()->first(),
            'information' => $information,
        ];
        return view('dashboard.basic_settings', $context);
    }

    public function linking_services()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $plan = $store->plan()->first();
        $information = $store->information()->first();

        if (!$plan) {
            if ($auth_user->getRoleNames()[0] == 'SuperAdmin') {
                $integration = true;
            } else {
                return redirect()->back()->with('error', 'null_user_plan');
            }
        } else {
            $integration = $plan->integration;
        }

        $context = [
            'title_page' => 'linking_services',
            'whatsapp' => \App\Attribute::where(['key' => 'whatsappApi'])->first(),
            'information' => $information,
            'integration' => $integration,
        ];
        return view('dashboard.linking_services', $context);
    }

    public function seo()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $information = $store->information()->first();
        if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        else
            $language = ['ar', 'en', 'fr'];
        $context = [
            'title_page' => 'seo',
            'language' => $language,
            'information' => $information,
        ];
        return view('dashboard.seo', $context);
    }

    public function store_staff()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $plan = $store->plan()->first();
        $users = $store->users()->get();
        if (!$plan) {
            if ($auth_user->getRoleNames()[0] == 'SuperAdmin') {
                $users_count = count($users) + 1;
            } else {
                $users_count = 1;
            }
        } else {
            $users_count = $plan->users_count;
        }
        $context = [
            'title_page' => 'store_staff',
            'route' => route('dashboard.admin.administrator.register'),
            'users' => $users,
            'users_count' => $users_count,
        ];
        return view('dashboard.store_staff', $context);
    }

    public function store_design()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $plan = $store->plan()->first();
        if ($plan) {
            if (!$plan->custom_design) {
                $store->update(['design' => null]);
            }
            $designs = $plan->DesignPlan()->where('status', true)->get();
        } else {
            return redirect()->back()->with('error', 'null_user_plan');
        }
        $valid_design = array();
        foreach ($designs as $design) {
            array_push($valid_design, $design->design()->first());
        }
        $obj = Design::all();
        $context = [
            'title_page' => 'store_design',
            'store' => $store,
            'valid_design' => $valid_design,
            'designs' => $obj,
        ];
        return view('dashboard.store_design', $context);
    }

    public function design_chosen(Request $request)
    {
        if (!array_key_exists("design", $request->all())) {
            return redirect()->back();
        }

        $id = $request->all()['design'];
        $design = Design::whereId($id)->first();
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();

        if (!$design or !$store->plan()->first()->custom_design) {
            return redirect()->back();
        }
        $plan = $store->plan()->first();
        $obj = DesignPlan::whereDesign_id($id)->wherePlan_id($plan->id)->whereStatus(true)->first();
        $css_style = $request->css_style;
        if ($request->hasFile('css_style.background_image')) {
            $background_name = 'background_image.' . $request->file('css_style.background_image')->getClientOriginalExtension();
            $request->file('css_style.background_image')->move(public_path("stores_assets/$store->domain"), $background_name);
            $css_style['background_image'] = "stores_assets/$store->domain/" . $background_name;
        } else {
            $css_style['background_image'] = $request->old_background_image;
        }
        if ($obj)
            $store->update(['design' => $id, 'css_style' => $css_style]);
        return redirect(route('dashboard.admin.store_settings.store_design'));
    }

    public function account_control()
    {
        $context = [
            'title_page' => 'account_control',
        ];
        return view('dashboard.account_control', $context);
    }

    public function models_stores()
    {
        $section = Section::whereType('models_stores')->first();
        $context = [
            'title_page' => 'models_stores',
            'section' => $section,
            'models' => Models::all(),
        ];
        return view('dashboard.models_stores', $context);
    }

    public function features_platform()
    {
        $section = Section::whereType('features_platform')->first();
        $context = [
            'title_page' => 'features_platform',
            'section' => $section,
            'features' => Features::all(),
        ];
        return view('dashboard.features_platform', $context);
    }

    public function sub_page()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $context = [
            'title_page' => 'sub_pages',
            'pages' => $store->pages()->get(),
        ];
        return view('dashboard.pages', $context);
    }

    public function domain_settings()
    {
        $store = auth()->user()->store()->first();
        if ($store->plan()->first()) {
            $customDomain = $store->customDomain()->whereStatus(true)->first();
            if (!$customDomain) {
                $customDomain = $store->customDomain()->first();
            }
            $context = [
                'title_page' => 'domain_settings',
                'store' => $store,
                'customDomain' => $customDomain,
                'plan_domain' => $store->plan()->first()->custom_domain,
            ];
            return view('dashboard.domain_settings', $context);
        }
        return redirect()->back()->with('error', 'null_user_plan');
    }

    public function store_payment()
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $information = $store->information()->first();
        if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        else
            $language = ['ar', 'en', 'fr'];
        $context = [
            'title_page' => 'payment_settings',
            'language' => $language,
            'store' => $store,
            'plan' => $store->plan()->first(),
            'information' => $information,
        ];
        //var_dump( $context['store'] );
        return view('dashboard.payment_settings', $context);
    }
}
//Developed Saed Z. Sinwar

