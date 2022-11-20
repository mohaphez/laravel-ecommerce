<?php

namespace App\Http\Controllers\AdminApi;

use App\apiChat;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Verta;
use DB;
use App\User;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index() {
      
		return view('AdminApi.ticket.chat');
	}
	/**
	 * [listGet description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function chat_list(Request $request) {
		if ($request->ajax()) {
            $users = DB::table('api_chats')->select('user_id')->where('read',0)
            ->distinct()
            ->get();
            $chats  = collect();
            foreach($users as $user)
            {
                $chats->push([
                     'id'=> $user->user_id,
                    'name' => User::find($user->user_id)->name." ".User::find($user->user_id)->family,
                    'mobile' =>User::find($user->user_id)->mobile,
                    'created_at' => apiChat::where('user_id',$user->user_id)->latest()->first()->created_at,
                    'count' => apiChat::where('user_id',$user->user_id)->where('read',0)->count(),
                ]);
            }
            $chats = $chats->sortByDesc('count');
                return Datatables::of($chats)->addColumn('action', function ($chat) {
					return '<a class="btn btn-default" href="'.route('apps.chat.show', ['id' => $chat["id"]]).'">نمایش</a>';
				})
				->editColumn('created_at',function ($chat) {
					$v = new Verta($chat["created_at"]);
                    return $v->format(' H:i   Y-n-j ');
                })->make(true);
		}
    }
    
    /**
     * 
     * user chats  show
     */
    public function show($id){
        $chats = apiChat::where('user_id',$id)->get();
        foreach($chats as $chat)
        {
            $chat->read = 1 ;
            $chat->save();
        }
        $mobile = User::find($id)->name." ".User::find($id)->family;
        $name = User::find($id)->mobile;
        return view('AdminApi.ticket.chat-show',compact('chats','mobile','name'));
    }

    public function anwser(Request $request)
    {
        $this->validate($request,['anwser'=>'required']);
        apiChat::create(['user_id'=>$request->id,'txt'=>$request->anwser,'sender'=>1,'read'=>1]);
        return back();
    }
}
