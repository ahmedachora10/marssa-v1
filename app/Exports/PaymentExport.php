<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class PaymentExport implements FromCollection
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
            if($this->branch_id != null){
                return Payment::where('branch_id', $this->branch_id)->get();
            }
            return Payment::all();
        }
        return;
    }
}
//Developed Saed Z. Sinwar