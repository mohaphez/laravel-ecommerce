<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    public function index(Request $request) {
		$brands     = Brand::all();
		return view("Admin.brand.index", compact('brands'));
    }
    
    	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, ['name' => 'required|string',
					'image_link'                     => 'required',
				]);
			if (!$request->has('id')) {
				$brand              = new Brand();
				$brand->name       = $request['name'];
				$brand->image  = $request['image_link'];
				$brand->save();
			} else {
				$brand              = Brand::where('id', $request['id'])->first();
				$brand->name       = $request['name'];
				$brand->image  = $request['image_link'];
				$brand->save();
			}
			return response()->json(['success'],200);
		}
    }
    
    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Brand $brand
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		 Brand::destroy($id);
		return redirect()->back();
	}
}
