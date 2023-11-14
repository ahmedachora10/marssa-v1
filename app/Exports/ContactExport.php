<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactExport implements FromCollection
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
            return Contact::all();
        }
        return;
    }
}
//Developed Saed Z. Sinwar
