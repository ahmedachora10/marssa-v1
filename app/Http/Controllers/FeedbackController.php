<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Feedback;
use App\Section;
use File;
use \App\User;
class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Feedback::all()->reverse();
        $section = Section::whereType('feedback')->first();
        return view('dashboard.feedback', ['title_page' => 'feedback', 'feedbacks' => $services, 'section' => $section]);
    }

    public function add($id = "")
    {
        $data = [
            'name_ar' => '',
            'name_fr' => '',
            'name_en' => '',
            'comment_ar' => '',
            'comment_fr' => '',
            'comment_en' => '',
            'image' => '',
        ];
        $title_page = 'add_feedback';
        $route = route('dashboard.admin.feedback.store');
        if ($id) {
            $data = Feedback::whereId($id)->first();
            $title_page = 'edit_feedback';
            $route = route('dashboard.admin.feedback.update', [$id]);
            if (!$data) {
                return redirect()->route('dashboard.admin.feedback.index');
            }
        }
        $context = ['title_page' => $title_page, 'data' => $data, 'route' => $route];
        return view('dashboard.add_feedback', $context);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_fr' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['nullable', 'string'],
            'comment_ar' => ['required', 'string'],
            'comment_fr' => ['required', 'string'],
            'comment_en' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $image = $request->file('image');
        $feedback = new Feedback;
        $feedback['name_ar'] = $request->all()['name_ar'];
        $feedback['name_en'] = $request->all()['name_en'];
        $feedback['name_en'] = $request->all()['name_fr'];
        $feedback['comment_ar'] = $request->all()['comment_fr'];
        $feedback['comment_ar'] = $request->all()['comment_ar'];
        $feedback['comment_en'] = $request->all()['comment_en'];
        $feedback->save();

        $store = User::role('SuperAdmin')->first()->store()->first();
        $new_name = 'feedback_' . $feedback['id'] . '_image.' . $image->getClientOriginalExtension();
        $image->move(public_path('stores_assets/' . $store->domain . '/feedback'), $new_name);
        $feedback->update(['image' => 'stores_assets/' . $store->domain . '/feedback/' . $new_name]);

        return redirect()->route('dashboard.admin.feedback.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => ['required', 'string'],
            'name_en' => ['nullable', 'string'],
            'name_fr' => ['nullable', 'string'],
            'comment_ar' => ['required', 'string'],
            'comment_fr' => ['required', 'string'],
            'comment_en' => ['nullable', 'string'],
            'image' => ['image', 'mimes:jpg,png,jpeg'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        Feedback::updateOrCreate(
            ['id' => $id],
            [
                'name_ar' => $request->all()['name_ar'],
                'name_en' => $request->all()['name_en'],
                'name_fr' => $request->all()['name_fr'],
                'comment_ar' => $request->all()['comment_ar'],
                'comment_fr' => $request->all()['comment_fr'],
                'comment_en' => $request->all()['comment_en'],
            ]
        );
        $image = $request->file('image');
        if ($image != "") {
            $store = User::role('SuperAdmin')->first()->store()->first();
            $new_name = 'feedback_' . $id . '_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('stores_assets/' . $store->domain . '/feedback'), $new_name);
            Feedback::updateOrCreate(
                ['id' => $id],
                [
                    'image' => '/' . 'stores_assets/' . $store->domain . '/feedback/' . $new_name
                ]
            );
        }
        return redirect()->route('dashboard.admin.feedback.index');
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:feedback,id'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        $feedback = Feedback::whereId($request->all()['id'])->first();
        $feedback_path = public_path($feedback['image']);
        if (File::exists($feedback_path)) File::delete($feedback_path);
        $feedback->delete();
        return response()->json(['status' => true]);
    }
}
//Developed Saed Z. Sinwar
