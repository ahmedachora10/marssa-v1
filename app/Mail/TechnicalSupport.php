<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TechnicalSupport extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (array_key_exists("status", $this->content)) {
            if ($this->content['status'] == 'payment') {
                $subject = 'Payment Process on hold Payment ID:';
            } elseif ($this->content['status'] == 'domain') {
                $subject = 'Domain Change Process on hold Process ID:';
            }
        } else {
            $subject = 'Reply to Your Message, Message ID:';

        };
        return $this->subject($subject . $this->content['id'])->markdown('dashboard.mail')->with('content', $this->content);
    }
}