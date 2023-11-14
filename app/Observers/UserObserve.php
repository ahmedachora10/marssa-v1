<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Queue;
use function GuzzleHttp\Promise\queue;

class UserObserve
{
    /**
     * Handle the user "created" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function created(User $user)
    {
        $messages = \App\Helper\Messages::get()->all();
        if ($messages) {
            foreach ($messages as $item) {
                Queue::later(now()->addSeconds($item['time']), new \App\Jobs\ScheduledMessages(PhoneFormat($user->mobile), $item));
            }
        }


    }

    /**
     * Handle the user "updated" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}