<?php

namespace App\Exports;

use App\Models\Subscribe;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscribeExport implements FromCollection
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
            return Subscribe::all();
        }
        return;
    }
}
//Developed Saed Z. Sinwar