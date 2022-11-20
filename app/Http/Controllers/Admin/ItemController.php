<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\ProductFeature;
use App\ProductItem;
use Hashids;
use Illuminate\Http\Request;

class ItemController extends Controller {
	public $successStatus = 200;
	public function index(Request $request) {
		$items = ProductItem::all();
		return $request->ajax()?view('Admin.ajax.items', compact('items')):view('Admin.items.items', compact('items'));
	}
	public function store(Request $request) {
		$this->validate($request, [
				'name' => 'required|string|max:255',
			]);
		$item = ProductItem::create(['name' => $request['name']]);
		return redirect()->route('show.item', Hashids::encode($item->id));
	}
	public function showItem(Request $request, $id) {
		$item = ProductItem::findOrFail(Hashids::decode($id))->first();
		return $request->ajax()?view('Admin.ajax.item', compact('item')):view('Admin.items.item', compact('item'));
	}
	public function storeItem(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'name' => 'required|string|max:255',
				]);
			$items = ProductItem::findOrFail(Hashids::decode($request['id']))->first();
			if ($items['items'] !== null) {
				$item                   = unserialize($items['items']);
				$item[$request['name']] = $request['default'];
				$item                   = serialize($item);
				$items['items']         = $item;
				$items->save();
			} else {
				$item           = array($request['name']=> $request['default']);
				$item           = serialize($item);
				$items['items'] = $item;
				$items->save();
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
	public function editItem(Request $request, $id, $index) {
		$items = ProductItem::findOrFail(Hashids::decode($id))->first();
		if ($items['items'] !== null) {
			$temp            = unserialize($items['items']);
			$item['id']      = $id;
			$item['name']    = $index;
			$item['default'] = $temp[$index];
		}
		return view('Admin.items.edit-item', compact('item'));
	}
	public function updateItem(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'name' => 'required|string|max:255',
				]);
			$items = ProductItem::findOrFail(Hashids::decode($request['id']))->first();
			if ($items['items'] !== null) {
				$item                   = unserialize($items['items']);
				$item[$request['name']] = $item[$request['index']];
				unset($item[$request['index']]);
				$item[$request['name']] = $request['default'];
				$item                   = serialize($item);
				$items['items']         = $item;
				$items->save();
				$products = ProductFeature::where('item', $request['index'])->get();
				foreach ($products as $product) {
					$product->item = $request['name'];
					$product->save();
				}
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
	public function deleteItem($id, $index) {
		$items = ProductItem::findOrFail(Hashids::decode($id))->first();
		if ($items['items'] !== null) {
			$item = unserialize($items['items']);
			unset($item[$index]);
			$item           = serialize($item);
			$items['items'] = $item;
			$items->save();
		}
		return redirect()->back();
	}

	public function deleteItems($id) {
		$items = ProductItem::findOrFail(Hashids::decode($id))->first();
		$items->delete();
		return redirect()->back();
	}

	public function editItems($id) {
		$item = ProductItem::findOrFail(Hashids::decode($id))->first();
		return view('Admin.items.edit-items', compact('item'));
	}

	public function updateItems(Request $request, $id) {
		$this->validate($request, [
				'name' => 'required|string|max:255',
			]);
		$item         = ProductItem::findOrFail(Hashids::decode($id))->first();
		$item['name'] = $request['name'];
		$item->save();
		return response()->json(['success', $this->successStatus]);
	}
}