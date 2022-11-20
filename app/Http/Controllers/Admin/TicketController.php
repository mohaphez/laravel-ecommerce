<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ticket;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Verta;
use App\TicketMessage;

class TicketController extends Controller {
	public $successStatus = 200;
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		return view('Admin.ticket.ticket');
	}
	/**
	 * [listGet description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function listGet(Request $request) {
		if ($request->ajax()) {
			$tickets = Ticket::select('id', 'user_id','title' ,'code', 'created_at','updated_at')->orderBy('updated_at', 'DESC')->get();
			return Datatables::of($tickets)->addColumn('name', function ($ticket) {
					return $ticket->user->name." ".$ticket->user->family;
				})->addColumn('date', function ($ticket) {
					$v = new Verta($ticket->created_at);
					return $v->format('Y-n-j');
				})->addColumn('title', function ($ticket) {
					return $ticket->title;
				})->addColumn('time', function ($ticket) {
					$v = new Verta($ticket->created_at);
					return $v->format('H:i');
				})->addColumn('action', function ($ticket) {
					return '<a href="'.route('admin.ticket.show', ['id' => $ticket->id]).'><button type="button" class="btn btn-primary">نمایش</button></a>';
				})->addColumn('message', function ($ticket) {
					$message = TicketMessage::where('ticket_id',$ticket->id)->where('sender',0)->where('read',0)->count();
					if($message != 0)
					return '<span class="badge" style="background-color: red;">'.$message.'</span>';
					else
					return '<span class="badge">'.$message.'</span>';
				})->escapeColumns([])
				->make(true);
		}
	}
	/**
	 * [show description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function show(Request $request, $id) {
		$ticket       = Ticket::where('id', $id)->first();
		$messages = TicketMessage::where('ticket_id',$ticket->id)->get();
		$ticket->read = 1;
		$ticket->save();
		foreach($messages as $message)
		{
			$message->read = 1;
			$message->save();
		}
		return view('Admin.ticket.ticket-show', compact('ticket','messages'));
	}

	public function reply(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, ['reply_body' => 'required|string']);
			$ticketMessage  = TicketMessage::create(['ticket_id'=> $request['id'],'message'=>$request["reply_body"],'sender'=>1,'user_id'=>Auth::user()->id]);
			$ticketMessage->save();
			return response()->json(['success', $this->successStatus]);
		}

	}

}
