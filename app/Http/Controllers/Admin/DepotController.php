<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;

class DepotController extends Controller {
	public function index() {
		$products = Product::all();
		return view('Admin.depot.depot', compact('products'));
	}
}
