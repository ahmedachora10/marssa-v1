<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Client;
use Illuminate\Database\Eloquent\Builder;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $context = ['title_page' => 'clients'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
            $clients = $auth_user->store()->first()->clients()->withCount('orders as order_count')->orderBy('order_count')->paginate(12);
        }elseif($auth_user->getRoleNames()[0] == 'SubUser'){
            $clients = $auth_user->store()->whereHas('branches',function(Builder $query) use($auth_user){
                $query->where('id',$auth_user->branch_id);
            })->first()->clients()->withCount('orders as order_count')->orderBy('order_count')->paginate(12);
        } else {

            $clients = Client::withCount('orders as order_count')->orderBy('order_count')->paginate(12);

        }
        $context['clients'] = $clients;

        return view('dashboard.clients', $context);
    }

}
//Developed Saed Z. Sinwar
