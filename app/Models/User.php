<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'role',
        'balance',
        'ref_link',
        'referral_id',
        'last_activity',
        'ip',
        'is_banned',
        'auth_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive()
    {
        return $this->where('is_banned', 0);
    }


    static function dialogs() {

        $id = \Auth::id();
        $key = md5( 'Dialogs_for_user_' . $id );
        \Cache::forget($key);
        return \Cache::rememberForever( $key, function() use($id) {
            $query = Message::select( \DB::raw('max(id) as id, from_user, to_user') )
                ->where(function($query) use ($id){

                    $query->where('from_user', $id)
                        ->where('from_delete', 0);

                })
                ->orWhere(function($query) use ($id){

                    $query->where('to_user', $id)
                        ->where('to_delete', 0);

                })
                ->groupBy('from_user', 'to_user')
                ->orderBy( 'id', 'desc' )
                ->get();

            $dialogs = [];
            $exist_dialogs = [];
            $messages_id = [];

            foreach( $query as $dialog ){
                if( isset($exist_dialogs[$dialog->from_user]) && in_array( $dialog->to_user, $exist_dialogs[$dialog->from_user] )
                    || isset($exist_dialogs[$dialog->to_user]) && in_array( $dialog->from_user, $exist_dialogs[$dialog->to_user] )
                ){
                    continue;

                } else {
                    $exist_dialogs[$dialog->from_user][] = $dialog->to_user;
                    $dialogs[] = $dialog;
                    $messages_id[] = $dialog->id;
                }
            }

            return Message::whereIn('id', $messages_id)
                ->orderBy('id', 'desc')
                ->get();
        });
    }

    public function subscription() {
        return $this->hasOne(Subscription::class, 'id', 'subscribe_id');
    }

    public function referrer() {
        return $this->hasOne(User::class, 'id', 'referral_id');
    }

    public function scans(){
        return $this->hasMany(PassportScans::class, 'user_id', 'id');
    }
}
