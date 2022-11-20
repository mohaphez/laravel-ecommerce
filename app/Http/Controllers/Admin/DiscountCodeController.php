<?php

namespace App\Http\Controllers\Admin;

use App\DiscountCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Verta;

class DiscountCodeController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$codes = DiscountCode::where('status',1)->get();
		return view('Admin.discount-code.code', compact('codes'));
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
		$this->validate($request, ['number' => 'required|numeric', 'price' => 'required|numeric', 'expire' => 'required']);
		for ($i = 1; $i <= $request['number']; $i++) {
			$seed = str_split('abcdefghijklmnopqrstuvwxyz'
				.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
				.'0123456789@#-');
			shuffle($seed);
			$rand = '';
			foreach (array_rand($seed, 8) as $k)$rand .= $seed[$k];

			$code = DiscountCode::where('code', $rand)->first();
			if ($code == null) {
				DiscountCode::create(['code' => $rand, 'type' => $request['type'], 'expire_at' => Verta::parse($request['expire'])->formatGregorian('Y-m-d H:i:s'), 'status' => 1, 'price' => $request['price']]);
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\DiscountCode  $discountCode
	 * @return \Illuminate\Http\Response
	 */
	public function show(DiscountCode $discountCode) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\DiscountCode  $discountCode
	 * @return \Illuminate\Http\Response
	 */
	public function edit(DiscountCode $discountCode) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\DiscountCode  $discountCode
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, DiscountCode $discountCode) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\DiscountCode  $discountCode
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$code = DiscountCode::findOrFail($id);
		$code->delete();
		return redirect()->back();
	}
}
