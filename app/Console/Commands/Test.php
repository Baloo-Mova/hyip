<?php

namespace App\Console\Commands;

use App\Helpers\CPayeer;
use App\Mail\SubmitEmail;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $payeer = new CPayeer(env("PAYEER_NUMBER"), env("PAYEER_API_ID"), env("PAYEER_API_KEY"));
        if ($payeer->isAuth()) {
            $balance = $payeer->getBalance()['balance'];
        } else {
            $balance = [];
        }
    }
}
