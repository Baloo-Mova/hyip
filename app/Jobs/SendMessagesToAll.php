<?php

namespace App\Jobs;

use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\Chats;
use App\Models\Message;

class SendMessagesToAll implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type;
    protected $message;
    protected $fromId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $message, $from_id)
    {
        $this->type = $type;
        $this->message = $message;
        $this->fromId = $from_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->type == 2){
            $mail = new PHPMailer;
            $settings = Settings::find(1);
            if(!isset($settings)){
                return false;
            }
        }

        $offset = 0;
        $limit = 100;

        while(true){
            $users = User::offset($offset)
                ->limit($limit)
                ->get();
            if(count($users) == 0){
                break;
            }

            $messages = [];

            foreach ($users as $user){

                if($user->id == $this->fromId){
                    continue;
                }
                if($this->type == 1){

                    $chat = Chats::where([
                        ['creator_id', '=', $this->fromId],
                        ['to_id', '=', $user->id]
                    ])
                    ->orWhere([
                        ['creator_id', '=', $user->id],
                        ['to_id', '=', $this->fromId]
                    ])->first();


                    if(!isset($chat)){
                        $chat = new Chats();
                        $chat->creator_id = $this->fromId;
                        $chat->to_id = $user->id;
                        $chat->save();
                    }
                    $messages[] = [
                        'from_user' => $chat->creator_id,
                        'to_user' => $chat->to_id,
                        'message' => $this->message,
                        'chat_id' => $chat->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];


                }else{

                    try {
                        $mail->isSMTP();
                        $mail->Host = $settings->smtp;
                        $mail->SMTPAuth = true;
                        $mail->Username = $settings->smtp_login;
                        $mail->Password = $settings->smtp_pasw;
                        $mail->SMTPSecure = $settings->smtp_secure;
                        $mail->Port = $settings->smtp_port;
                        $mail->CharSet = 'UTF-8';
                        $mail->setFrom($settings->smtp_login);
                        $mail->addAddress($user->email);

                        $mail->Subject = "Сообщение от админа ".env("APP_NAME");
                        $mail->Body = $this->message;
                        if(preg_match("/<[^<]+>/", $this->message, $m) != 0){
                            $mail->IsHTML(true);
                        }

                        $mail->send();
                    } catch (\Exception $ex) {
                        continue;
                    }
                    $mail->ClearAllRecipients();
                    sleep(2);
                }

            }

            if($this->type == 1){
                Message::Insert($messages);
            }else{

            }

            $offset += $limit;

        }

        return true;

    }
}
