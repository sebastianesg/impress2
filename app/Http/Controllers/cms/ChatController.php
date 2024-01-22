<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $aid = Auth::user()->id;
        $allChats = [];
        $chats = DB::select("select group_concat(distinct(`ids`)) ids from (
                            select group_concat(distinct(`to`)) ids from chat_messages where `from`= $aid group by `from`
                            UNION
                            select group_concat(distinct(`from`)) ids from chat_messages where `to`= $aid group by `to`) t1");
        $ids = array_unique(explode(',', $chats[0]->ids));
        foreach($ids as $uid){
            if (!empty($uid)){
                if ($uid != $aid) {
                    $ch = DB::select("select * from chat_messages where (`from`= $uid and `to` = $aid) || (`from` = $aid and `to` = $uid) order by 1 desc LIMIT 1");
                    $ch = Chat::hydrate($ch);
                    $allChats[] = $ch[0];
                }
            }
        }

        $ids[] = $aid;
        $users = User::whereNotIn('id', $ids)->get();
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];
        return view('cms.chat.chat', ['pageConfigs' => $pageConfigs, 'contacts' => $users, 'chats' => $allChats]);
    }

    public function getMessages(Request $request)
    {
        $uid = $request->input('uid', 0);
        $aid = Auth::user()->id;
        $msgs = DB::select("select * from chat_messages where (`from`= $uid and `to` = $aid) || (`from` = $aid and `to` = $uid) LIMIT 50");
        $msgs = Chat::hydrate($msgs);
        $day = $left = $prev = false;
        $allMsgs = [];
        foreach ($msgs as $msg) {
            $left = $msg->to == $aid ? 1 : -1;
            if (!$prev) $prev = $left;
            if ($prev && $prev != $left){
                echo view('cms.chat.message', ['msgs' => $allMsgs, 'day' => $day, 'left' => $prev, 'user' => User::find($uid), 'me' => Auth::user()]);
                $allMsgs = [];
                $prev = $left;
            }
            $allMsgs[] = $msg;

            ///ACTILIZO EL LEIDO
            $msg->read = 1;
            $msg->save();
        }

        if (count($msgs) > 0)echo view('cms.chat.message', ['msgs' => $allMsgs, 'day' => $day, 'left' => $left, 'user' => User::find($uid), 'me' => Auth::user()]);
    }

    public function sendMessage(Request $request){
        $chat = new Chat($request->all());
        $chat->from = Auth::user()->id;
        if (!empty($chat->message)) $chat->save();
        else {
            if ($request->hasFile('file')) {
                $file = request()->file('file');
                $name = $file->hashName();
                $file->storeAs('', $name, 'chat_files');
                $chat->file = $name;
                $chat->save();
            }
        }
    }
}
