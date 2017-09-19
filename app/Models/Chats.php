<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $table = 'chats';

    public $timestamps = true;

    protected $fillable = [
        'creator_id',
        'to_id'
    ];

    public function dialog_user()
    {
        $current_user = \Auth::id();

        if( $current_user == $this->creator_id ){
            return $this->to_user();
        }
        else{
            return $this->from_user();
        }

    }

    public function to_user()
    {
        return $this->belongsTo( User::class, 'creator_id' );
    }

    public function from_user()
    {
        return $this->belongsTo( User::class, 'to_id' );
    }

    public function user_name()
    {
        $current_user = \Auth::id();

        if( $current_user == $this->creator_id ){
            return $this->from_user();
        }
        else{
            return $this->to_user();
        }

    }

    public function get_messages()
    {
        return $this->hasMany(Message::class, 'chat_id', 'id')->orderBy('created_at', 'asc');
    }

}
