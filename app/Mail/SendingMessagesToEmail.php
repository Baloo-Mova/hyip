<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendingMessagesToEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $text;

    /**
     * Create a new message instance.
     *
     * @param $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('NO_REPLY_EMAIL'))
            ->view('emails.sending-messages')
            ->with([
                'text' => $this->text
            ]);
    }
}
