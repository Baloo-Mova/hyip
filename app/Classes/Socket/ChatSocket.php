<?php

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BaseSocket;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ratchet\ConnectionInterface;

class ChatSocket extends BaseSocket
{
    protected $clients;
    protected $users;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);

        switch ($data->type) {
            case 'message':
                $store = new Message([
                    'from_user' => $this->users[$from->resourceId]->id,
                    'to_user'   => $data->to_user,
                    'message'   => $data->message,
                ]);
                $store->save();

                foreach ($this->clients as $client) {
                    if ($this->users[$client->resourceId]['id'] == $data->to_user || $client->resourceId == $from->resourceId) {
                        $client->send(json_encode([
                            'from_name' => $this->users[$from->resourceId]['login'],
                            'message'   => $data->message,
                            'date'      => date("d.m.Y H:i", strtotime(Carbon::now()))
                        ]));
                    }
                }
                break;

            case 'connect':

                if (!$user = User::where(['auth_token' => $data->token])->first()) {
                    $from->close();
                    break;
                }

                $this->users[$from->resourceId] = $user;

                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}