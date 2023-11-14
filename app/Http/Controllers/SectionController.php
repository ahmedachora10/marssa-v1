<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Section;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($type, Request $request)
    {
        Section::updateOrCreate(
            ['type' => $type],
            [
                'status' => $request->all()['status'],
            ]
        );
        toast(__('master.Successfully'),'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }
}
//Developed Saed Z. Sinwar