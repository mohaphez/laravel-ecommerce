<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Ticket;
use Auth;
use Hashids;
use Illuminate\Http\Request;
use Verta;
use App\Setting;
use Mail;

class TicketPanelController extends Controller {
	public $successStatus = 200;
	/**
	 * [ticket show user tickets ]
	 * @return [view] [return user ticket view]
	 */
	public function index(Request $request) {
		if ($request->ajax()) {
			$tickets = Ticket::where('user_id', Auth::user()->id)->get();
			return view('Front.panel.ticket.user-ticket', compact('tickets'));
		}
	}
	/**
	 * [ticket_form send ticket form view]
	 * @return [view]    [ticket form view]
	 */
	public function create(Request $request) {
		if ($request->ajax()) {
			return view('Front.panel.ticket.send-ticket');
		}
	}
	/**
	 * [save_ticket save user ticket form]
	 * @param  Request $request [give ticket values name,body]
	 * @return [json]           [success value]
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'title' => 'required|string|max:255',
					'body'  => 'required|string',
				]);
			$v    = new Verta();
			$code = $v->timestamp;
			Ticket::create(['title' => $request['title'], 'body' => $request['body'], 'user_id' => Auth::user()->id, 'code' => $code]);
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * [ticket_show show ticket and response]
	 * @param  [integer] $id [ticket id ]
	 * @return [collection]     [ticket values]
	 */
	public function show(Request $request, $id) {
		if ($request->ajax()) {
			$ticket = Ticket::where('id', Hashids::decode($id))->first();
			return view('Front.panel.ticket.ticket-show', compact('ticket'));
		}
	}
	/**
	 * contact page function
	 */
 public function contact(){
	 $contact = Setting::first();
	 return view('Front.contact.contact',compact('contact'));
 }

/**
 * contact send to email function
 */
	public function contact_send(Request $request){
		$this->validate($request,['name'=>'required','email'=>'required','phone'=>'required','message'=>'required']);
		 $contact = Setting::first();
$to = $contact->contact_email;
$subject = " ارتباط با ما فروشگاه ".$contact->name;
$name = $request->name;
$phone = $request->phone;
$mail = $request->email;
$messages= $request->message;

// mail($to,$subject,$message,$headers);
$email = Mail::send('emails.email', ['name'=>$name,'phone'=>$phone,'mail'=>$mail,'messages'=>$messages], function ($message) use ($mail,$subject,$to,$name){
					$message->from($mail, $name);
					$message->to($to)->subject($subject);
			});
		return "ok";
	}
}
