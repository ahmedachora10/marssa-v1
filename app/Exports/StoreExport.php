<?php

namespace App\Exports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class StoreExport implements FromCollection
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
        if ($auth_user->getRoleNames()[0] == 'SuperAdmin') {
            if ($this->branch_id != null){
                return Store::whereHas('branches',function(Builder $query){
                    $query->where('id',$this->branch_id);
                })->get();
            }
            return Store::all();
        }
        return;
    }
}
//Developed Saed Z. Sinwar