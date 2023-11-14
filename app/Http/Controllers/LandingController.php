<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Section;
use App\Features;
use App\Models;
use App\Plan;
use App\Page;
use App\Feedback;
use App\Contact;
use IP2LocationLaravel;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Visitors;
use App\User;

class LandingController extends Controller
{
    public function __construct()
    {
        $this->create_log();
    }

    public function index()
    {
        $models = Models::all();
        $plans = Plan::all();
        $features = Features::all();
        $pages = Page::whereStoreId('1')->get();
        $feedback = Feedback::all()->shuffle()->take(4);
        $counters = Counter::all();
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();

        $section = [
            'models_stores' => Section::whereType('models_stores')->first()->status ?? 0,
            'features_platform' => Section::whereType('features_platform')->first()->status ?? 0,
            'feedback' => Section::whereType('feedback')->first()->status ?? 0,
        ];
        $head_data = [
            'title_ar' => $information['title_page_ar'] . ' - ' . __('site.main_menu'),
            'title_en' => $information['title_page_en'] . ' - ' . __('site.main_menu'),
            'title_fr' => $information['title_page_fr'] . ' - ' . __('site.main_menu'),
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_en'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $information['preview'],
        ];
        $context = [
            'head_data' => $head_data,
            'models' => $models,
            'plans' => $plans,
            'feedback' => $feedback,
            'pages' => $pages,
            'section' => $section,
            'features' => $features,
            'counters' => $counters,
            'information' => $information,
        ];

        return view('Landing.index', $context);
    }

    public function pricing()
    {
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();
        $pages = Page::whereStoreId('1')->get();
        $head_data = [
            'title_ar' => $information['title_page_ar'] . ' - ' . __('site.pricing'),
            'title_en' => $information['title_page_en'] . ' - ' . __('site.pricing'),
            'title_fr' => $information['title_page_fr'] . ' - ' . __('site.pricing'),
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_en'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $information['preview'],
        ];
        $plans = Plan::all();
        $context = [
            'head_data' => $head_data,
            'plans' => $plans,
            'pages' => $pages,
            'information' => $information,
        ];
        return view('Landing.pricing', $context);
    }

    public function show_page($page)
    {
        $page = Page::whereLink($page)->first();
        if ($page) {
            $pages =  Page::whereStoreId('1')->get();
            $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();
            $head_data = [
                'title_ar' => $page['title_ar'],
                'title_en' => $page['title_en'],
                'title_fr' => $page['title_fr'],
                'description_ar' => $page['description_ar'],
                'description_en' => $page['description_en'],
                'description_fr' => $page['description_fr'],
                'keyword_ar' => $information['keyword_ar'],
                'keyword_en' => $information['keyword_en'],
                'keyword_fr' => $information['keyword_fr'],
                'icon' => $information['preview'],
            ];
            $context = [
                'head_data' => $head_data,
                'pages' => $pages,
                'page' => $page,
                'information' => $information,
            ];
            return view('Landing.show_page', $context);
        } else {
            return redirect()->route('site.index');
        }
    }

    public function send_contact_us(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'content' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json(__('site.send_contact_us_fail'));
        }
        $referer = str_replace(env('APP_URL'), '/', $request->headers->get('referer'));
        $referer = str_replace('https://', '', $referer);
        $referer = str_replace('http://', '', $referer);
        $referer = substr($referer, -1) === '/' ? substr($referer, 0, -1) : $referer;
        $new_contact = Contact::create([
            'name' => $request->all()['name'],
            'email' => $request->all()['email'],
            'content' => $request->all()['content'],
            'referer' => $referer,
        ]);
        if ($new_contact->save()) {
            return response()->json(__('site.send_contact_us_done'));
        }
        return response()->json(__('site.send_contact_us_fail'));
    }

    protected function create_log()
    {
        $ips = \Request::ip();
        $position = IP2LocationLaravel::get($ips);
        $agent = new Agent();

        $device = $agent->device();
        if ($device == "Bot") {
            return;
        }
        $robot = $agent->robot();
        if ($robot != 0) {
            $platform = $agent->platform();
            $browser = $agent->browser();
            $browser_version = $agent->version($browser);
            $platform_version = $agent->version($platform);
            $ipAddress = $position['ipAddress'];
            $ipNumber = $position['ipNumber'];
            $ipVersion = $position['ipVersion'];
            $latitude = $position['latitude'];
            $longitude = $position['longitude'];
            $countryName = $position['countryName'];
            $countryCode = $position['countryCode'];
            $timeZone = $position['timeZone'];
            $zipCode = $position['zipCode'];
            $cityName = $position['cityName'];
            $regionName = $position['regionName'];
            $data = new Visitors;
            $data['url'] = explode("?", \Request::getRequestUri())[0];
            $data['device'] = $device;
            $data['platform'] = $platform;
            $data['browser'] = $browser;
            $data['robot'] = $robot;
            $data['browser_version'] = $browser_version;
            $data['platform_version'] = $platform_version;
            $data['ipAddress'] = $ipAddress;
            $data['ipNumber'] = $ipNumber;
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;
            $data['ipVersion'] = $ipVersion;
            $data['countryName'] = $countryName;
            $data['countryCode'] = $countryCode;
            $data['timeZone'] = $timeZone;
            $data['zipCode'] = $zipCode;
            $data['cityName'] = $cityName;
            $data['regionName'] = $regionName;
            $data->store()->associate(User::role('SuperAdmin')->first()->store()->first());
            $data->save();
        }
    }
}
//Developed Saed Z. Sinwar