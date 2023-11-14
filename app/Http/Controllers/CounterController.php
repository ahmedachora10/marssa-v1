<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Counter;
use App\Section;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type = 'counters';
        $counters = Counter::all();
        $data = Section::where('type', $type)->first();

        return view('dashboard.counters', ['title_page' => 'counters', 'counters' => $counters, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:counters,id'],
            'title_ar' => ['required', 'string'],
            'title_en' => ['nullable', 'string'],
            'count' => ['required', 'string'],
            'numerical_ar' => ['required', 'string'],
            'numerical_en' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        Counter::updateOrCreate(
            ['id' => $request->all()['id']],
            [
                'title_ar' => $request->all()['title_ar'],
                'title_en' => $request->all()['title_en'],
                'count' => $request->all()['count'],
                'numerical_ar' => $request->all()['numerical_ar'],
                'numerical_en' => $request->all()['numerical_en'],
                'icon' => $request->all()['icon'],
            ]
        );
        return response()->json(['status' => true]);
    }
}
//Developed Saed Z. Sinwar
