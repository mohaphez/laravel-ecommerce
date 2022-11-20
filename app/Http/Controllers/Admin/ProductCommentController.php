<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\ProductComment;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Verta;

class ProductCommentController extends Controller {
	public $successStatus = 200;
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		return view('Admin.comment.comment');
	}
	/**
	 * [listGet description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function listGet(Request $request) {
		if ($request->ajax()) {
			$comments = ProductComment::select('id', 'product_id', 'user_id', 'title', 'created_at')->orderBy('created_at', 'DESC')->get();
			return Datatables::of($comments)->addColumn('product', function ($comment) {
					return $comment->product->name;
				})->addColumn('date', function ($comment) {
					$v = new Verta($comment->created_at);
					return $v->format('Y-n-j');
				})->addColumn('email', function ($comment) {
					return $comment->user->email;
				})->addColumn('title', function ($comment) {
					return $comment->title;
				})->addColumn('action', function ($comment) {
					return '<a href="'.route('admin.comment.show', ['id' => $comment->id]).'" ><button type="button" class="btn btn-primary">نمایش</button></a>';
				})
				->make(true);
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $id) {
		if ($request->ajax()) {
			$this->validate($request, ['title' => 'required|string', 'comment' => 'required|string']);
			$comment             = new ProductComment();
			$comment->title      = $request['title'];
			$comment->comment    = $request['comment'];
			$comment->user_id    = Auth::user()->id;
			$comment->like       = $request['like'];
			$comment->status     = 1;
			$comment->product_id = $id;
			$comment->save();
			return response()->json(['success', $this->successStatus]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ProductComment  $productComment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id) {
		$comment       = ProductComment::where('id', $id)->first();
		$comment->read = 1;
		$comment->save();
		return $request->ajax()?view('Admin.ajax.comment-show', compact('comment')):view('Admin.comment.comment-show', compact('comment'));
	}

	public function reply(Request $request) {
		if ($request->ajax()) {
			$comment                = ProductComment::where('id', $request['id'])->first();
			$comment->reply_user_id = Auth::user()->id;
			$comment->reply_comment = $request['reply_comment'];
			$comment->status        = $request->has('status')?1:0;
			$comment->save();
			return response()->json(['success', $this->successStatus]);
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ProductComment  $productComment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ProductComment $productComment) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\ProductComment  $productComment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ProductComment $productComment) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ProductComment  $productComment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ProductComment $productComment) {
		//
	}
}
