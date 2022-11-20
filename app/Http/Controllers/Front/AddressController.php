<?php
namespace App\Http\Controllers\Front;
use App\Address;
use App\Http\Controllers\Controller;
use Auth;
use Hashids;
use Illuminate\Http\Request;

class AddressController extends Controller {
	public $successStatus = 200;
	/**
	 * Display a listing of the user-addresses
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if ($request->ajax()) {
			$addresses = Address::where('user_id', Auth::user()->id)->get();
			return view('Front.panel.address.address-index', compact('addresses'));
		}
	}
	/**
	 * Show the form for creating a new address-form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		if ($request->ajax()) {
			return view('Front.panel.address.address-create');
		}
	}
	/**
	 * Store a newly created resource in address-create
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'name'      => 'required|string|max:255',
					'address'   => 'required|string',
					'codeposti' => 'required|numeric|digits:10',
				]);
			Address::create(['name' => $request['name'], 'address' => $request['address'], 'codeposti' => $request['codeposti'], 'user_id' => Auth::user()->id]);
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Address  $address
	 * @return \Illuminate\Http\Response
	 */
	public function show(Address $address) {
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Address  $address
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		if ($request->ajax()) {
			$address = Address::findOrFail(Hashids::decode($id))->first();
			return view('Front.panel.address.address-edit', compact('address'));
		}
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Address  $address
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if ($request->ajax()) {
			$this->validate($request, [
					'name'      => 'required|string|max:255',
					'address'   => 'required|string',
					'codeposti' => 'required|numeric|digits:10',
				]);
			$address = Address::findOrFail(Hashids::decode($id))->first();
			$address->update(['name' => $request['name'], 'address' => $request['address'], 'codeposti' => $request['codeposti'], 'user_id' => Auth::user()->id]);
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Address  $address
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if ($request->ajax()) {
			$address = Address::findOrFail(Hashids::decode($id))->first();
			$address->delete();
			$addresses = Address::where('user_id', Auth::user()->id)->get();
			return view('Front.panel.address.address-index', compact('addresses'));
		}
	}
}