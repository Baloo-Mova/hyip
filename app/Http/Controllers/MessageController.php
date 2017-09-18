<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\CreateMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SocialNetwork;
use App\Models\SocialNetworksShares;
use App\Models\Contact;

class MessageController extends Controller
{
    private $_cache_key_dialogs = 'Dialogs_for_user_';
    private $_cache_key_messages = 'Current_dialog_';

    public function index() {
        //TODO я писал логику получения сообщений в модели пользователя; пример отображения есть в ЛК пользователя;
        $messages = Message::with('getFromUser')->where(['to_user' => \Auth::user()->id])->get();
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.mail.index',[
                'messages' => isset($messages) ? $messages : [],
                'data' => $data
            ]);
    }

    public function show($user_id = null)
    {
        $user = null;
        if( !is_null($user_id) ){
            $user = User::find($user_id);
            if( is_null($user) ){
                abort(404);
            }
        }

        $current_user = \Auth::user();

        $key = md5( $this->_cache_key_messages . $current_user->id . '_' . $user_id  );
        \Cache::forget($key);
        $chat = \Cache::rememberForever( $key, function() use ( $user_id, $current_user) {

            Message::where('to_user', $current_user->id)
                ->where('to_delete', 0)
                ->where('from_user', $user_id)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            $messages = Message::where(function($query) use( $user_id, $current_user ){
                    $query->where('from_user', $user_id)
                        ->where('to_user', $current_user->id)
                        ->where('to_delete', 0);

                })
                ->orWhere(function($query) use( $user_id, $current_user ){

                    $query->where('from_user', $current_user->id)
                        ->where('to_user', $user_id)
                        ->where('from_delete', 0);

                })
                ->orderBy('id', 'asc')
                ->get();

            $result = [];

            foreach($messages as $message){
                $message->from_user = User::whereId( $message->from_user )->first();
                $message->to_user = User::whereId( $message->to_user )->first();
                $result[] = $message;
            }

            return $result;
        });

        return view('cabinet.mail.chat', [
            'chat' => $chat,
            'user' => $current_user,
            'to_user' => $user,
        ]);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new CreateMessageRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user_id         = $request->get('to_user');
        $current_user_id = \Auth::id();

        if ($current_user_id == $user_id) {
            return redirect()->back()->withInput($request->all())->withErrors(['The sender and receiver are the same']);
        }

        Message::create([
            'from_user'   => $current_user_id,
            'to_user'     => $user_id,
            'message'   => trim(strip_tags($request->get('message'))),
        ]);

        $this->_clearCache($current_user_id, $user_id);

        return redirect()->back();
    }



    private function _clearCache( $user1, $user2 )
    {

        if( $user1 > 0 && $user2 > 0 ){
            \Cache::forget( md5( $this->_cache_key_dialogs . $user1 ) );
            \Cache::forget( md5( $this->_cache_key_dialogs . $user2 ) );
            \Cache::forget( md5( $this->_cache_key_messages . $user1 . '_' . $user2 ));
            \Cache::forget( md5( $this->_cache_key_messages . $user2 . '_' . $user1 ));
        }
        return ;
    }

    public function chat($id)
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $shares = SocialNetworksShares::find(1);
        $email = Contact::email()->get();
        $phones = Contact::phones()->get();
        $data = [
            'contacts' => [
                'phones' => $phones,
                'emails' => $email,
                'social' => [
                    'links' => $social,
                    'share' => json_decode($shares->shares)
                ]
            ]
        ];
        return view('chat', ['data' => $data]);
    }

}