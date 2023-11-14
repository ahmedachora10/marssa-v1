<?php

namespace App\Http\Controllers;

use App\User;
use App\Models;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id = "")
    {
        $data = [
            'title_ar' => '',
            'title_en' => '',
            'title_fr' => '',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'screenshot' => '',
            'icon' => '',
        ];
        $title_page = 'add_model';
        $route = route('dashboard.admin.models.store');
        if ($id) {
            $data = Models::whereId($id)->first();
            $title_page = 'model_edit';
            $route = route('dashboard.admin.models.update', [$id]);
            if (!$data) {
                return redirect()->route('dashboard.admin.store_settings.models_stores');
            }
        }
        $context = ['title_page' => $title_page, 'data' => $data, 'route' => $route];
        return view('dashboard.add_model', $context);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'title_fr' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'link' => ['required', 'string'],
            'icon' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'screenshot' => ['required', 'image', 'mimes:jpg,png,jpeg'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $model = new Models();
        $model['title_ar'] = $request->all()['title_ar'];
        $model['title_en'] = $request->all()['title_en'];
        $model['title_fr'] = $request->all()['title_fr'];
        $model['description_ar'] = $request->all()['description_ar'];
        $model['description_en'] = $request->all()['description_en'];
        $model['description_fr'] = $request->all()['description_fr'];
        $model['link'] = $request->all()['link'];
        $model->save();

        $icon = $request->file('icon');
        $screenshot = $request->file('screenshot');

        $store = User::role('SuperAdmin')->first()->store()->first();

        $new_name = 'model_' . $model['id'] . '_icon.' . $icon->getClientOriginalExtension();
        $icon->move(public_path('stores_assets/' . $store->domain . '/models'), $new_name);
        $model->update(['icon' => 'stores_assets/' . $store->domain . '/models/' . $new_name]);

        $new_name = 'model_' . $model['id'] . '_screenshot.' . $screenshot->getClientOriginalExtension();
        $screenshot->move(public_path('stores_assets/' . $store->domain . '/models'), $new_name);
        $model->update(['screenshot' => 'stores_assets/' . $store->domain . '/models/' . $new_name]);

        return redirect()->route('dashboard.admin.store_settings.models_stores');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'title_fr' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'link' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        Models::updateOrCreate(
            ['id' => $id],
            [
                'title_ar' => $request->all()['title_ar'],
                'title_en' => $request->all()['title_en'],
                'title_fr' => $request->all()['title_fr'],
                'description_ar' => $request->all()['description_ar'],
                'description_en' => $request->all()['description_en'],
                'description_fr' => $request->all()['description_fr'],
                'link' => $request->all()['link'],
            ]
        );
        $icon = $request->file('icon');
        $screenshot = $request->file('screenshot');
        $store = User::role('SuperAdmin')->first()->store()->first();

        if ($icon != "") {
            $new_name = 'model_' . $id . '_icon.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('stores_assets/' . $store->domain . '/models'), $new_name);
            Models::updateOrCreate(
                ['id' => $id],
                [
                    'icon' => '/' . 'stores_assets/' . $store->domain . '/models/' . $new_name
                ]
            );
        }

        if ($screenshot != "") {
            $new_name = 'model_' . $id . '_screenshot.' . $screenshot->getClientOriginalExtension();
            $screenshot->move(public_path('stores_assets/' . $store->domain . '/models'), $new_name);
            Models::updateOrCreate(
                ['id' => $id],
                [
                    'screenshot' => '/' . 'stores_assets/' . $store->domain . '/models/' . $new_name
                ]
            );
        }
        return redirect()->route('dashboard.admin.store_settings.models_stores');
    }

    public function delete($id)
    {
        $model = Models::whereId($id)->first();
        if ($model) {
            $model->delete();
        }
        return redirect()->back();
    }
}
//Developed Saed Z. Sinwar
