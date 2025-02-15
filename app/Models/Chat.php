<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sender_id', 'receiver_id', 'message', 'seen'];

    function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->Select('id','avatar');
    }

    function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id')->Select('id','avatar');
    }
}
