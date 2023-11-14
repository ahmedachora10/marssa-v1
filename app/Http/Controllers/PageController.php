<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
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
            'content_ar' => '',
            'content_en' => '',
            'content_fr' => '',
            'link' => '',
        ];
        $title_page = 'add_page';
        $route = route('dashboard.admin.pages.store');
        if ($id) {
            $data = Page::whereId($id)->first();
            $title_page = 'page_edit';
            $route = route('dashboard.admin.pages.update', [$id]);
            if (!$data) {
                return redirect()->route('dashboard.admin.store_settings.pages');
            }
        }
        $context = ['title_page' => $title_page, 'data' => $data, 'route' => $route];
        return view('dashboard.add_page', $context);
    }

    public function register(Request $request)
    {
        $store = auth()->user()->store()->first();
        $validator = Validator::make($request->all(), [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'title_fr' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'content_ar' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'content_fr' => ['required', 'string'],
            'link' => ['required', 'string', 'max:191', Rule::unique('pages')->where(function ($query) use ($store) {
                return $query->where('store_id', $store->id);
            })],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $page = new Page();
        $page['title_ar'] = $request->all()['title_ar'];
        $page['title_en'] = $request->all()['title_en'];
        $page['title_fr'] = $request->all()['title_fr'];
        $page['description_ar'] = $request->all()['description_ar'];
        $page['description_en'] = $request->all()['description_en'];
        $page['description_fr'] = $request->all()['description_fr'];
        $page['content_ar'] = $request->all()['content_ar'];
        $page['content_en'] = $request->all()['content_en'];
        $page['content_fr'] = $request->all()['content_fr'];
        $page['link'] = $request->all()['link'];
        $page->store()->associate($store);
        $page->save();

        return redirect()->route('dashboard.admin.store_settings.pages');
    }

    public function update(Request $request, $id)
    {
        $store = auth()->user()->store()->first();
        $validator = Validator::make($request->all(), [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'title_fr' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'content_ar' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'content_fr' => ['required', 'string'],
            'link' => ['required', 'string', 'max:191', Rule::unique('pages')->where(function ($query) use ($store, $id) {
                return $query->where('store_id', $store->id)->where('id', '!=', $id);
            })],

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        Page::updateOrCreate(
            ['id' => $id],
            [
                'title_ar' => $request->all()['title_ar'],
                'title_en' => $request->all()['title_en'],
                'title_fr' => $request->all()['title_fr'],
                'description_ar' => $request->all()['description_ar'],
                'description_en' => $request->all()['description_en'],
                'description_fr' => $request->all()['description_fr'],
                'content_ar' => $request->all()['content_ar'],
                'content_en' => $request->all()['content_en'],
                'content_fr' => $request->all()['content_fr'],
                'link' => $request->all()['link'],
            ]
        );
        return redirect()->route('dashboard.admin.store_settings.pages');
    }

    public function delete($id)
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $page = $store->pages()->whereId($id)->first();
        if ($page) {
            $page->delete();
        }
        return redirect()->back();
    }
}
//Developed Saed Z. Sinwar
