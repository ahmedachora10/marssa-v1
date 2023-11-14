<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitors;

class VisitorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $auth_user = auth()->user();
        $visitors = $auth_user->store()->first()->visitors()->where('robot', '0')->get()->reverse();
        return view('dashboard.visitors', ['title_page' => 'visitors', 'visitors' => $visitors]);
    }
}
//Developed Saed Z. Sinwar