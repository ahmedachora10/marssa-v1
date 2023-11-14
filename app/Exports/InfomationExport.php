<?php

namespace App\Exports;

use App\Models\Information;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class InfomationExport implements FromCollection
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
                return $info = $auth_user->store()->whereHas('branches',function(Builder $query){
                    $query->where('id',$this->branch_id);
                })->first()->information()->get();
            }
            $info = $auth_user->store()->first()->information()->get();
            return $info;
        } else {
            return Information::all();
        }
    }
}
//Developed Saed Z. Sinwar