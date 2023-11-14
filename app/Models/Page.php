<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function route_page()
    {
        $host = $this->store()->first()->customDomain()->whereStatus(true)->first();
        if ($host) {
            return '/show/' . $this->link;
        }
        return route('store.show_page', ['sub_domain' => $this->store->domain, 'page' => $this->link]);

    }

}
//Developed Saed Z. Sinwar
