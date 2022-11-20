<?php

namespace App\Http\Controllers\Vue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketMessage;
use Auth;
class TicketController extends Controller
{
    public function index(){
        $temps = Ticket::where('user_id',Auth::user()->id)->select('id','created_at','updated_at','title','status')->orderBy('updated_at','DESC')->get()->toArray();
        $tickets = array();
        foreach($temps as $ticket)
        {
            $ticket["unread"] =  TicketMessage::where('ticket_id',$ticket["id"])->where('sender',1)->where('read',0)->count();
            array_push($tickets,$ticket);
        }
        return response()->json(['tickets'=>$tickets],200);
    }
    /**
     * Created  an Ticket 
     */
    public function TicketStore(Request $request){
        $this->validate($request,[
            'title'=> 'required|string',
            'body' =>  'required|string'
        ]);
		$code = verta()->timestamp;
        $ticket = Ticket::create(['title'=>$request->title,'body'=>$request->body,'user_id'=>Auth::user()->id,'code'=> $code ]);
        return response()->json(['message'=>'پیام شما با موفقیت ثبت شد !'],200);
    }
    /**
     * Show Ticket all messages and Details
     */
    public function TicketShow($id){
        $ticket = Ticket::with(array('user'=>function($query){
            $query->select('id','name','family');
        }))->where('id',$id)->where('user_id',Auth::user()->id)->select('id','created_at','updated_at','title','status','body','user_id')->first();
        $messages =  TicketMessage::with(array('user'=>function($query){
            $query->select('id','name','family');
        }))->where('ticket_id',$ticket->id)->select('message','created_at','sender','user_id')->get();
        if($ticket == null )
         return response()->json(['error'=>'متاسفانه شما دسترسی ندارید!'],422);
         else{
             $all = TicketMessage::where('ticket_id',$ticket->id)->where('sender',1)->get();
            foreach($all as $message)
            {
                  $message->read = 1;
                  $message->save();
            }
            return response()->json(['ticket'=>$ticket,'messages'=>$messages],200);
         }
         
    }
    /**
     * Store an Ticket messages 
     */
    public function TicketMessageStore(Request $request,$id)
    {
        $this->validate($request,[
            'message' =>  'required|string'
        ]);
        $check = Ticket::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if($check)
        {
            $reply = TicketMessage::create(['message'=>$request->message,'ticket_id'=>$id,'user_id'=>Auth::user()->id]);
            $ticket["user"]["name"] = Auth::user()->name;
            $ticket["user"]["family"] = Auth::user()->family;
            $ticket["message"] = $reply->message;
            $ticket["sender"]  = 0;
            $check->read = 0 ;
            $check->save();
            return response()->json(['message'=>'پیام شما با موفقیت ثبت شد !','ticket'=>$ticket],200);
        }else
        {
            return response()->json(['error'=>'متاسفانه شما دسترسی ندارید!'],422);
        }
        
    }
}
