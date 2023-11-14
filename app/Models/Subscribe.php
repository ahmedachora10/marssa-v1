<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribe extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function FormatDeadline()
    {
        return date('m/d/Y', strtotime($this->deadline));
    }

    public function DeadlineForNewSubscription($new)
    {
        $current_plan = $this->plan()->first();
        $new_plan = Plan::whereId($new)->first();
        if ($current_plan->price != 0 and $new_plan->price > 0) {
            $percentage = $new_plan->price / $current_plan->price;
            $deadline_difference = Carbon::parse($this->deadline)->diffInMinutes(now());
            $deadline_percentage = $deadline_difference / $percentage;
            $new_deadline = Carbon::now()->addMinutes($deadline_percentage);
            return $new_deadline;
        }
        if ($new_plan->price == 0) {
            $new_deadline = Carbon::now()->addMonth();
            return $new_deadline;
        }
        return Carbon::now();
    }
}
//Developed Saed Z. Sinwar
