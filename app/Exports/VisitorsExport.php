<?php

namespace App\Exports;

use App\Models\Visitors;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class VisitorsExport implements FromCollection
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
                return $auth_user->store()->whereHas('branches',function(Builder $query){
                    $query->where('id',$this->branch_id);
                })->first()->visitors()->get();

            }
            return $auth_user->store()->first()->visitors()->get();
        } else {
            return Visitors::all();
        }

    }
}
//Developed Saed Z. Sinwar