<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class ClientExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

     public $branch_id = null;

     public function __construct($branch_id){
        $this->branch_id = $branch_id;
     }

    public function collection()
    {
        #  use($this->branch_id)
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
            if($this->branch_id != null):
                return $clients = $auth_user->store()->first()->clients()->whereHas('orders.payment',function(Builder $query){
                    $query->where('order_payments.branch_id',$this->branch_id);
                })->get();
            endif;

            $clients = $auth_user->store()->first()->clients()->get();
            return $clients;
        } else {
            return Client::all();
        }
    }
}
//Developed Saed Z. Sinwar
