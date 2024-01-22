<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

//use Panoscape\History\HasHistories;

class Chat extends Model
{
    use HasFactory;
    //use HasHistories;

    protected $fillable = ['from', 'to', 'message', 'file', 'read'];

    protected $table = 'chat_messages';

    public function toUser(){
        return $this->hasOne('App\Models\User', 'id', 'to')->withDefault(new User());
    }

    public function fromUser(){
        return $this->hasOne('App\Models\User', 'id', 'from')->withDefault(new User());
    }

    public function getAnyUser(){
        $from = $this->fromUser;
        $to = $this->toUser;
        return $from->id != Auth::user()->id ? $from : $to;
    }

    public function getDate(){
        return Carbon::parse($this->created_at)->format('H:i');
    }

    public function getPending(){
        $to = Auth::user()->id;
        $f = $to == $this->to ? $this->from : $this->to;
        return Chat::where('from', $f)->where('to', $to)->where('read', 0)->count();
    }

    public function getFile(){
        return Storage::disk('chat_files')->url($this->file);
    }

    /*public function getModelLabel(){
        return 'Chat';
    }*/
}
