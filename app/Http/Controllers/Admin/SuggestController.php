<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class SuggestController extends Controller {
	public function index() {
		$products = Product::where('suggest', 1)->get();
		return view('Admin.suggest.suggest', compact('products'));
	}
	public function store(Request $request) {
		$this->validate($request, ['code' => 'required']);
		$product = Product::where('code', $request['code'])->first();
		if ($product != null) {
			$product->suggest = 1;
			$product->save();
		}
		return redirect()->back();
	}

	public function destroy($id) {
		$suggest          = Product::findOrFail($id);
		$suggest->suggest = 0;
		$suggest->save();
		return redirect()->back();
	}
}
