<?php

namespace App\Http\Controllers\AdminApi;

use App\ApiDiscountCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Verta;
use Carbon;

class DiscountCodeController extends Controller
{
   	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$codes = ApiDiscountCode::where('status',1)->get();
		foreach($codes as $code )
		{
			if($code->expire_at <=  Carbon\Carbon::today())
			 {
				 $code->status =2;
				 $code->save();
			 }
		}
		$codes = ApiDiscountCode::all();
		return view('AdminApi.discount-code.code', compact('codes'));
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
        $this->validate($request, ['price' => 'required|numeric', 'expire' => 'required']);
        $flag = true;
		while ($flag == true) {
			//if code variable is not empty work else
            if($request->code != "")
            {
				$rand = $request->code;
				$code = ApiDiscountCode::where('code', $rand)->first();
				if ($code != null) {
					$seed = str_split('abcdefghijklmnopqrstuvwxyz'
				.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
				.'0123456789@#-');
			     shuffle($seed);
			$rand = '';
			foreach (array_rand($seed, 8) as $k)$rand .= $seed[$k];
			$flag = false;
				ApiDiscountCode::create(['code' => $rand, 'type' => $request['type'], 'expire_at' => Verta::parse($request['expire'])->formatGregorian('Y-m-d H:i:s'), 'status' => 1, 'price' => $request['price']]);
				return redirect()->back();
				}
				//if code variable is empty work else
            }else{
			$seed = str_split('abcdefghijklmnopqrstuvwxyz'
				.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
				.'0123456789@#-');
			shuffle($seed);
			$rand = '';
			foreach (array_rand($seed, 8) as $k)$rand .= $seed[$k];
            }
			$code = ApiDiscountCode::where('code', $rand)->first();
			if ($code == null) {
                $flag = false;
				ApiDiscountCode::create(['code' => $rand, 'type' => $request['type'], 'expire_at' => Verta::parse($request['expire'])->formatGregorian('Y-m-d H:i:s'), 'status' => 1, 'price' => $request['price']]);
				return redirect()->back();
			}
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ApiDiscountCode  $ApiDiscountCode
	 * @return \Illuminate\Http\Response
	 */
	public function show(ApiDiscountCode $ApiDiscountCode) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ApiDiscountCode  $ApiDiscountCode
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ApiDiscountCode $ApiDiscountCode) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\ApiDiscountCode  $ApiDiscountCode
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ApiDiscountCode $ApiDiscountCode) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ApiDiscountCode  $ApiDiscountCode
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$code = ApiDiscountCode::findOrFail($id);
		$code->delete();
		return redirect()->back();
	}
}
