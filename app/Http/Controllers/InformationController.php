<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Information;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notes(Request $request)
    {
        $request->validate(['payment_note' => 'required|max:1000', 'thanks_note' => 'required|max:1000']);
        $store = auth()->user()->store;
        $store->paymentNote()->delete();
        $store->paymentNote()->create(['key' => 'payment_note', 'value' => $request->payment_note, 'store_id' => $store->id,]);
        $store->thanksNote()->delete();
        $store->thanksNote()->create(['key' => 'thanks_note', 'value' => $request->thanks_note, 'store_id' => $store->id,]);
        toast(__('master.Successfully'), 'success');
        return back();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $information = $store->information()->first();
        $data = $request->all();

        $plan = $store->plan()->first();
        if (!$plan) {
            if ($auth_user->getRoleNames()[0] == 'SuperAdmin') {
                $integration = true;
            } else {
                $integration = false;
            }
        } else {
            $integration = $plan->integration;
        }

        if (array_key_exists("title_page_ar", $data)) $information->update(['title_page_ar' => $data['title_page_ar']]);
        if (array_key_exists("title_page_en", $data)) $information->update(['title_page_en' => $data['title_page_en']]);
        if (array_key_exists("title_page_fr", $data)) $information->update(['title_page_fr' => $data['title_page_fr']]);
        if (array_key_exists("description_ar", $data)) $information->update(['description_ar' => $data['description_ar']]);
        if (array_key_exists("description_en", $data)) $information->update(['description_en' => $data['description_en']]);
        if (array_key_exists("description_fr", $data)) $information->update(['description_fr' => $data['description_fr']]);
        if (array_key_exists("keyword_ar", $data)) $information->update(['keyword_ar' => $data['keyword_ar']]);
        if (array_key_exists("keyword_en", $data)) $information->update(['keyword_en' => $data['keyword_en']]);
        if (array_key_exists("keyword_fr", $data)) $information->update(['keyword_fr' => $data['keyword_fr']]);
        if (array_key_exists("address", $data)) $information->update(['address' => $data['address']]);
        if (array_key_exists("phone", $data)) $information->update(['phone' => $data['phone']]);
        if (array_key_exists("email", $data)) $information->update(['email' => $data['email']]);
        if (array_key_exists("facebook", $data)) $information->update(['facebook' => $data['facebook']]);
        if (array_key_exists("twitter", $data)) $information->update(['twitter' => $data['twitter']]);
        if (array_key_exists("whatsapp", $data)) $information->update(['whatsapp' => $data['whatsapp']]);
        if (array_key_exists("instagram", $data)) $information->update(['instagram' => $data['instagram']]);
        if (array_key_exists("youtube", $data)) $information->update(['youtube' => $data['youtube']]);
        if (array_key_exists("currency", $data)) $information->update(['currency' => $data['currency']]);
        if (array_key_exists("head_text", $data)) $information->update(['head_text' => $data['head_text']]);
        if (array_key_exists("video_url", $data)) $information->update(['video_url' => $data['video_url']]);
        if (array_key_exists("header_type", $data)) $information->update(['header_type' => $data['header_type']]);
        if (array_key_exists("question_ar", $data)) {

            $questWithAnswer = [];

            foreach ($data['question_ar'] as $key => $quet) {
                $smallArray = [
                    'question' => $quet,
                    'answer' => $data['answer_ar'][$key],
                ];

                array_push($questWithAnswer, $smallArray);
            }
            $information->update(['questions_ar' => json_encode($questWithAnswer)]);

        }


        if (array_key_exists("question_en", $data)) {

            $questWithAnswer = [];

            foreach ($data['question_en'] as $key => $quet) {
                $smallArray = [
                    'question' => $quet,
                    'answer' => $data['answer_en'][$key],
                ];

                array_push($questWithAnswer, $smallArray);
            }
            $information->update(['questions_en' => json_encode($questWithAnswer)]);

        }


        if (array_key_exists("question_fr", $data)) {

            $questWithAnswer = [];

            foreach ($data['question_fr'] as $key => $quet) {
                $smallArray = [
                    'question' => $quet,
                    'answer' => $data['answer_fr'][$key],
                ];

                array_push($questWithAnswer, $smallArray);
            }
            $information->update(['questions_fr' => json_encode($questWithAnswer)]);

        }


        if (array_key_exists("currency", $data)) {
            if($data['currency'] == "MRU"){
                $store->max_indebtedness = 1200; 
                $store->save();
            } else if ($data['currency'] == "أوقية قديمة"){
                $store->max_indebtedness = 12000; 
                $store->save();
            }
        }

        function findKey($array, $keySearch)
        {
            foreach ($array as $key => $item) {
                if ($key == $keySearch) {
                    return true;
                } elseif (is_array($item) && findKey($item, $keySearch)) {
                    return true;
                }
            }
            return false;
        }

        if (findKey($data, 'paypal') or findKey($data, 'Paiement_when_receiving') or findKey($data, 'Bankily') or findKey($data, 'Bank_transfer')) {
//            dd($data['payment'],array_merge($auth_user->store->payment_methods , $data['payment']));
            if (array_key_exists('payment', $data)) {
                $auth_user->store()->update(['payment_methods' => array_merge($auth_user->store->payment_methods, $data['payment'])]);
            }

//            $auth_user->store()->update(['payment_methods' => $data['payment']]);
        }
        if ($integration) {
            if (array_key_exists("facebook_pixel_id", $data)) $information->update(['facebook_pixel_id' => $data['facebook_pixel_id']]);
            if (array_key_exists("google_tag_manager", $data)) $information->update(['google_tag_manager' => $data['google_tag_manager']]);
        }
        if (array_key_exists("shipping", $data)) {
            $auth_user->store()->update(['shipping' => $data['shipping']]);
        }

        if (array_key_exists("display_sold", $data)) {
            $auth_user->store()->update(['display_sold' => $data['display_sold']]);
        }


        if (array_key_exists("language", $data)) {
            $language = $data['language'];
            $language_array = [0, 1, 2, 3, 4];
            if (!$plan or !$plan->language) {
                $language_array = [0, 1, 3, 4];
            }
            if (!array_search($language, $language_array)) {
                $language = 0;
            }
            $auth_user->store()->update(['language' => $language]);
        }

        $icon = $request->file('icon');
        if ($icon != "") {
            $icon_name = 'logo_browser.' . $icon->getClientOriginalExtension();
            $icon->move(public_path("stores_assets/$store->domain"), $icon_name);
            $information->update(['icon' => "stores_assets/$store->domain/" . $icon_name]);
        }
        $logo = $request->file('logo');
        if ($logo != "") {
            $logo_name = 'logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path("stores_assets/$store->domain"), $logo_name);
            $information->update(['logo' => "stores_assets/$store->domain/" . $logo_name]);
        }
        $preview = $request->file('preview');
        if ($preview != "") {
            $preview_name = 'preview.' . $preview->getClientOriginalExtension();
            $preview->move(public_path("stores_assets/$store->domain"), $preview_name);
            $information->update(['preview' => "stores_assets/$store->domain/" . $preview_name]);
        }
        $banner_head = $request->file('banner_head');
        if ($banner_head != "") {
            $banner_h = 'banner_head.' . $banner_head->getClientOriginalExtension();
            $banner_head->move(public_path("stores_assets/$store->domain"), $banner_h);
            $information->update(['banner_head' => "stores_assets/$store->domain/" . $banner_h]);
        }
        $banner_footer = $request->file('banner_footer');
        if ($banner_footer != "") {
            $banner_f = 'banner_footer.' . $banner_footer->getClientOriginalExtension();
            $banner_footer->move(public_path("stores_assets/$store->domain"), $banner_f);
            $information->update(['banner_footer' => "stores_assets/$store->domain/" . $banner_f]);
        }
        $footer_payments_image = $request->footer_payments_image;
        if ($footer_payments_image != "") {
            $array = [];
            foreach ($footer_payments_image as $item) {
                $name = md5(now() . uniqid());
                $banner_f = $name . '.' . $item->getClientOriginalExtension();
                $item->move(public_path("stores_assets/$store->domain"), $banner_f);
                $array[] = "stores_assets/$store->domain/" . $banner_f;
            }
            $information->update(['footer_payments_image' => json_encode($array)]);
        } else {
            foreach (json_decode($information->footer_payments_image ?? '') ?? [] as $item) {
                unlink(base_path('public/' . $item));
                $information->update(['footer_payments_image' => '{}']);
            }
        }
        $home = $request->file('home_image');
        if ($home != "") {
            $home_imag = 'home_image.' . $home->getClientOriginalExtension();
            $home->move(public_path("stores_assets/$store->domain"), $home_imag);
            $information->update(['home_image' => "stores_assets/$store->domain/" . $home_imag]);
        }
        $hoim2 = $request->file('home_im2');
        if ($hoim2 != "") {
            $homeimg2 = 'home_im2.' . $hoim2->getClientOriginalExtension();
            $hoim2->move(public_path("stores_assets/$store->domain"), $homeimg2);
            $information->update(['home_im2' => "stores_assets/$store->domain/" . $homeimg2]);
        }


        if ($request->file('video_upload') || $request->video_link || $request->file('warning_video_upload') || $request->video_warning_link) {
            $site = \App\site::first();
            if ($site) {
                // if($request->video_link) {
                $site->video_link = $request->video_link;
                $site->save();
                // }

                if ($request->file('video_upload')) {


                    $file = $request->file('video_upload');
                    $file_name = time() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('videos'), $file_name);

                    $site->video_upload = $file_name;

                    $site->save();

                }


                // if($request->video_warning_link) {
                $site->video_warning_link = $request->video_warning_link;
                $site->save();
                // }

                if ($request->file('warning_video_upload')) {


                    $file = $request->file('warning_video_upload');
                    $file_name = time() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('videos'), $file_name);

                    $site->warning_video_upload = $file_name;

                    $site->save();

                }


            } else {
                $site = new \App\site();

                if ($request->video_link) {
                    $site->video_link = $request->video_link;
                    $site->save();
                }

                if ($request->file('video_upload')) {


                    $file = $request->file('video_upload');
                    $file_name = time() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('videos'), $file_name);

                    $site->video_upload = $file_name;

                    $site->save();

                }

                if ($request->video_warning_link) {
                    $site->video_warning_link = $request->video_warning_link;
                    $site->save();
                }

                if ($request->file('warning_video_upload')) {


                    $file = $request->file('warning_video_upload');
                    $file_name = time() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('videos'), $file_name);

                    $site->warning_video_upload = $file_name;

                    $site->save();

                }
            }
        }


        $site = \App\site::first();
        if ($site) {

            $site->welcome_video_link = $request->welcome_video_link;
            $site->save();


            if ($request->file('welcome_video_upload')) {


                $file = $request->file('welcome_video_upload');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('videos'), $file_name);

                $site->welcome_video_upload = $file_name;

                $site->save();

            }


            $site->warning_2_video_link = $request->warning_2_video_link;
            $site->save();


            // if($request->tutorial_video_link) {
            // $array = explode('v=', $request->tutorial_video_link);
            //$site->video_tutorial = $array[1];
            $site->video_tutorial = $request->tutorial_video_link;
            $site->save();
            // }


            //if(!empty($request->header_message)){
            $site->header_message = $request->header_message;
            $site->save();
            //}

            if ($request->file('warning_2_video_upload')) {


                $file = $request->file('warning_2_video_upload');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('videos'), $file_name);

                $site->warning_2_video_upload = $file_name;

                $site->save();

            }


        } else {
            $site = new \App\site();


            $site->video_link = $request->video_link;
            $site->save();


            if ($request->file('video_upload')) {


                $file = $request->file('video_upload');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('videos'), $file_name);

                $site->video_upload = $file_name;

                $site->save();

            }

            if ($request->video_warning_link) {
                $site->video_warning_link = $request->video_warning_link;
                $site->save();
            }

            if ($request->file('warning_video_upload')) {


                $file = $request->file('warning_video_upload');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('videos'), $file_name);

                $site->warning_video_upload = $file_name;

                $site->save();

            }
        }


        if (!empty($request->commission)) {
            $this->setEnvCommision('commission', $request->commission);
        }
        
        if (!empty($request->affiliate_rate)) {
            $this->setEnvCommision('affiliate_rate', $request->affiliate_rate);
        }


        toast(__('master.Successfully'), 'success');
        return back();
        //return back()->with('success', 'Successfully');
    }

    public function remove(Request $request)
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $information = $store->information()->first();
        $information->update([$request->banner => ""]);
        return response()->json(array());

    }


    private function setEnvCommision($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function whatsapp(Request $request)
    {
        $request->validate([
            'token' => 'required|max:255',
            'instance_id' => 'required|max:255',
            'status' => 'required|in:1,0',
        ]);
        $attribute = \App\Attribute::where(['key' => 'whatsappApi'])->delete();
        $attribute = \App\Attribute::create(
            [
                'key' => 'whatsappApi',
                'value' => json_encode($request->except('_token')),
                'store_id' => auth()->id()
            ]
        );

        toast(__('master.Successfully'), 'success');
        return back();
    }
}

//Developed Saed Z. Sinwar
