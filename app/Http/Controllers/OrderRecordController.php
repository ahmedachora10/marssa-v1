<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
//Developed Saed Z. Sinwar