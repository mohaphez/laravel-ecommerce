<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\apiChat;
class ChatController extends Controller
{
    /**
     * store chats 
     */
    public function  chatStore(Request $request){
        $this->validate($request,['txt'=>'required']);
        $api =  new apiChat();
        $api->user_id = Auth::user()->id;
        $api->sender  = 0 ; 
        $api->txt     = $request->txt ;
        $api->read    = 0 ;
        $api->save();
        return response()->json("ok", 200);
    }
    /**
     * get chats 
     */
    public function getChats(){
        $chats = apiChat::select('sender','txt','created_at')->where('user_id',Auth::user()->id)->orderBy('created_at','ASC')->get();
        return response()->json($chats, 200);
    }
}
