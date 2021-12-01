<?php

namespace App\Http\Controllers;

use App\Models\Listroomchat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class MessageController extends Controller
{
    public function messageinput(Request $req)
    {
        # code...
    }
    public function viewchat(Request $request)
    {
        return view('profile.chat');
    }
    public function sendto(Request $request)
    {
        $ob =  $request->get('data');
        $user = User::where('name', $ob['sendto'])->get();

        $chat_msg = $ob['message'];
        $user_send = $ob['user_id'];
        $user_receive =  $user[0]->id;
        $message = new Message();
        $message->chat_msg = $chat_msg;
        $message->user_send = $user_send;
        $message->user_receive = $user_receive;
        $state = $message->save();

        $listmessage = Listroomchat::where('user_id', $ob['user_id'])->get();
        echo sizeof((array)$listmessage);
        if (sizeof($listmessage) == 0) {
            echo sizeof((array)$listmessage);
            $createlist = new Listroomchat();
            $createlist->user_id = $user_send;
            $createlist->listchat = $user_receive;
            $create = $createlist->save();
        } else {

            $str = $listmessage[0]->listchat;
            $ar = explode(",", $str);

            if (!in_array($user_receive, $ar)) {
                $str = $str . ',' . $user_receive;
                $createlist = Listroomchat::where('user_id', $ob['user_id'])
                    ->update([
                        'listchat' => $str
                    ]);
            }
        }
        $listreceive = Listroomchat::where('user_id', $user_receive)->get();
        if (sizeof($listreceive) == 0) {
            $createlist = new Listroomchat();
            $createlist->user_id = $user_receive;
            $createlist->listchat = $user_send;
            $create = $createlist->save();
        } else {
            $s = 'sdas,dasd,dasd';
            $str = $listreceive[0]->listchat;
            $ar = explode(",", $str);
            if (!in_array($user_send, $ar)) {
                $str = $str . ',' . $user_send;
                $createlist = Listroomchat::where('user_id', $user_receive)
                    ->update([
                        'listchat' => $str
                    ]);
            }
        }
    }
    public function getlist(Request $request)
    {
        $re = $request->get('data');
        $user_id = $re['user_id'];
        $listchat = Listroomchat::where('user_id', $user_id)->get();
        $ar = explode(',', $listchat[0]->listchat);
        $list_user = array();
        foreach ($ar as $item) {
            $user = User::where('id', $item)->get();
            array_push($list_user, $user);
        }



        echo  json_encode($list_user);
    }
    public function getmessage(Request $request)
    {
        $re = $request->get('data');
        $user_send = $re['user_send'];
        $user_receive = $re['user_receive'];
       

        $messageall = Message::where(function ($query) use ($user_send,$user_receive) {
            $query->where('user_send', $user_send)
                  ->where('user_receive', $user_receive);
        })->orWhere(function ($query)use ($user_send,$user_receive) {
            $query->where('user_send', $user_receive)
            ->where('user_receive', $user_send);
        })->get();//->latest()เอาอันสุดท้านก่อน
  

       
        return  response()->json($messageall);
    }
}
