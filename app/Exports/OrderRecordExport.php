<?php

namespace App\Exports;

use App\Models\OrderRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class OrderRecordExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

     protected $branch_id = null;

     function __construct($branch_id){
        $this->branch_id = $branch_id;
     }


    public function collection()
    {
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
            if($this->branch_id != null){
                return $order_records = $auth_user->store()->first()->order_records()->whereHas('order.payment',function(Builder $query){
                    $query->where('order_payments.branch_id',$this->branch_id);
                })->get();
            }

            $order_records = $auth_user->store()->first()->order_records()->get();
            return $order_records;
        } else {
            return OrderRecord::all();
        }
    }
}
//Developed Saed Z. Sinwar