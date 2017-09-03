<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendingMessagesToEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emails;
    protected $text;

    /**
     * Create a new job instance.
     *
     * @param $emails
     * @param $text
     */
    public function __construct($emails, $text)
    {
        $this->emails   = $emails;
        $this->text     = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            \Mail::to($email)
                ->send(new \App\Mail\SendingMessagesToEmail($this->text));
        }
    }
}
