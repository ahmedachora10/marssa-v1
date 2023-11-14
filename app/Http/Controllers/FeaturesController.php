<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class FeaturesController extends Controller
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
            'icon' => '',
        ];
        $title_page = 'add_feature';
        $route = route('dashboard.admin.features.store');
        if ($id) {
            $data = Features::whereId($id)->first();
            $title_page = 'feature_edit';
            $route = route('dashboard.admin.features.update', [$id]);
            if (!$data) {
                return redirect()->route('dashboard.admin.store_settings.features_platform');
            }
        }
        $context = ['title_page' => $title_page, 'data' => $data, 'route' => $route];
        return view('dashboard.add_feature', $context);
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
            'icon' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $feature = new Features();
        $feature['title_ar'] = $request->all()['title_ar'];
        $feature['title_en'] = $request->all()['title_en'];
        $feature['title_fr'] = $request->all()['title_fr'];
        $feature['description_ar'] = $request->all()['description_ar'];
        $feature['description_en'] = $request->all()['description_en'];
        $feature['description_fr'] = $request->all()['description_fr'];
        $feature['icon'] = $request->all()['icon'];
        $feature->save();

        return redirect()->route('dashboard.admin.store_settings.features_platform');
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
            'icon' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        Features::updateOrCreate(
            ['id' => $id],
            [
                'title_ar' => $request->all()['title_ar'],
                'title_en' => $request->all()['title_en'],
                'title_fr' => $request->all()['title_fr'],
                'description_ar' => $request->all()['description_ar'],
                'description_en' => $request->all()['description_en'],
                'description_fr' => $request->all()['description_fr'],
                'icon' => $request->all()['icon'],
            ]
        );
        return redirect()->route('dashboard.admin.store_settings.features_platform');
    }

    public function delete($id)
    {
        $feature = Features::whereId($id)->first();
        if ($feature) {
            $feature->delete();
        }
        return redirect()->back();
    }
}
//Developed Saed Z. Sinwar
