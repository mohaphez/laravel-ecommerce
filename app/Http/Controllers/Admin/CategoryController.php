<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Hashids;
use Illuminate\Http\Request;

class CategoryController extends Controller {
	public $successStatus = 200;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$categories = Category::with('subcategory')->get();
		return $request->ajax()?view('Admin.ajax.category', compact('categories')):view('Admin.category.category', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('-');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'category' => 'required|string|max:255',
				]);
			if ($request['catid'] == null) {
				$category = Category::create(['name' => $request['category'],'image'=>$request["image"]]);
				$i        = 0;
				if ($request['subcategory'] != null) {
					foreach ($request['subcategory'] as $sub) {
						if ($sub[$i] != null) {
							SubCategory::create(['name' => $sub, 'category_id' => $category->id]);
						}
						$i++;
					}
				}
			} else {
				$category       = Category::findOrFail(Hashids::decode($request['catid']))->first();
				$category->name = $request['category'];
				$category->image = $request['image'];
				$category->slug = null;
				$category->save();
				if ($request['subcategory'] != null) {
					foreach (array_combine($request['subcategory'], $request['id']) as $key => $value) {
						if (isset($key)) {
							if ($value != "no") {
								$sub       = SubCategory::where('id', $value)->first();
								$sub->name = $key;
								$sub->slug = null;
								$sub->save();
							} else {
								SubCategory::create(['name' => $key, 'category_id' => $category->id]);
							}
						}
					}
				}
			}

			return response()->json(['success', $this->successStatus]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if ($request->ajax()) {
			$category = Category::findOrFail($id);
			return view('-', compact($category));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if (!$request->ajax()) {
			$this->validate($request, [
					'name' => 'required|string|max:255',
				]);
			$category = Category::findOrFail($id);
			$category->update(['name' => $request['name']]);
			return response()->json(['success', $this->successStatus]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if ($request->ajax()) {
			$category = Category::findOrFail(Hashids::decode($id))->first();
			$category->delete();
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 *
	 */
	public function subdelete($sub) {
		$sub = SubCategory::where('id', $sub)->first();
		$sub->delete();
		return redirect()->back();
	}
}
