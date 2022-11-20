<?php
namespace App\Http\Controllers\Admin;
use App\Baner;
use App\Category;
use App\Http\Controllers\Controller;
use App\Slideshow;
use Illuminate\Http\Request;

class SlideshowController extends Controller {
	public $successStatus = 200;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$slides     = Slideshow::all();
		$categories = Category::all();
		$baner[0]   = Baner::where('position', 1)->first();
		$baner[1]   = Baner::where('position', 2)->first();
		$baner[2]   = Baner::where('position', 3)->first();
		$baner[3]   = Baner::where('position', 4)->first();
		$baner[4]   = Baner::where('position', 5)->first();
		$baner[5]   = Baner::where('position', 6)->first();
		$baner[6]   = Baner::where('position', 7)->first();
		return $request->ajax()?view("Admin.ajax.slide", compact('slides', 'categories', 'baner')):view("Admin.slide.slide", compact('slides', 'categories', 'baner'));
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
	public function store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, ['title' => 'required|string',
					'alt'                            => 'string',
					'image_link'                     => 'required',
					'weight'                         => 'numeric'
				]);
			if (!$request->has('id')) {
				$slide              = new Slideshow();
				$slide->title       = $request['title'];
				$slide->description = $request['description'];
				$slide->alt         = $request['alt'];
				$slide->image_link  = $request['image_link'];
				$slide->url         = $request['url'];
				$slide->weight      = $request['weight'];
				$slide->save();
			} else {
				$slide              = Slideshow::where('id', $request['id'])->first();
				$slide->title       = $request['title'];
				$slide->description = $request['description'];
				$slide->alt         = $request['alt'];
				$slide->image_link  = $request['image_link'];
				$slide->url         = $request['url'];
				$slide->weight      = $request['weight'];
				$slide->save();
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Slideshow  $slideshow
	 * @return \Illuminate\Http\Response
	 */
	public function show(Slideshow $slideshow) {
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Slideshow  $slideshow
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Slideshow $slideshow) {
		//
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Slideshow  $slideshow
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Slideshow $slideshow) {
		//
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Slideshow  $slideshow
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$slide = Slideshow::where('id', $id)->first();
		$slide->delete();
		return redirect()->back();
	}

	public function Banerstore(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, ['alt' => 'required|string', 'link' => 'required|string']);

			$baner = Baner::where('position', $request['position'])->first();
			if ($baner == null) {
				$baner           = new Baner();
				$baner->link     = $request['link'];
				$baner->url      = $request['url'];
				$baner->alt      = $request['alt'];
				$baner->title      = $request['title'];
				$baner->status   = $request->has('status')?1:0;
				$baner->position = $request['position'];
				$baner->save();

			} else {
				$baner->link     = $request['link'];
				$baner->url      = $request['url'];
				$baner->alt      = $request['alt'];
				$baner->title      = $request['title'];
				$baner->status   = $request->has('status')?1:0;
				$baner->position = $request['position'];
				$baner->save();
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
}