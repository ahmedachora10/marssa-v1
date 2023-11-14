<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
class UsersExport implements FromCollection
{

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
                })->first()->users()->select('id', 'name', 'email', 'mobile', 'status')->get();
            }
            return $auth_user->store()->first()->users()->select('id', 'name', 'email', 'mobile', 'status')->get();
        } else {
            return User::select('id', 'name', 'email', 'mobile', 'status')->where('permission', 2)->get();
        }
    }
}

//Developed Saed Z. Sinwar