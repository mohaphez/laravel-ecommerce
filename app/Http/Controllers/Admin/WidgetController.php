<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hashids;
use App\Widget;
use App\Product;
class WidgetController extends Controller
{
    public $successStatus = 200;
	public function index(Request $request) {
		$widgets = Widget::all();
		return view('Admin.widget.index',compact('widgets'));
    }
    

	public function store(Request $request) {
		$this->validate($request, [
				'name' => 'required|string|max:255',
			]);
		$item = Widget::create(['name' => $request['name'],'weight'=>$request['weight'] ? $request['weight'] : 1]);
		return redirect()->route('show.widget', Hashids::encode($item->id));
    }
    

	public function showWidget(Request $request, $id) {
		$item = Widget::findOrFail(Hashids::decode($id))->first();
		return view('Admin.widget.widget', compact('item'));
	}
	public function storeWidget(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'code' => 'required|string|max:255',
				]);
            $items = Widget::findOrFail(Hashids::decode($request['id']))->first();
            $product = Product::where('code',$request['code'])->first();
            if($product == null)
            {
                return response()->json(['error'=>"محصول مورد نظر موجود نیست "]);
            }
			if ($items['name'] !== null) {
                $item                   = unserialize($items['items']);
				$item[$request['code']] = $product->name;
				$item                   = serialize($item);
				$items['items']         = $item;
				$items->save();
			} else {
				$item           = array($request['code']=> $product->name);
				$item           = serialize($item);
				$items['items'] = $item;
				$items->save();
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
	public function editWidget(Request $request, $id, $index) {
		$items = Widget::findOrFail(Hashids::decode($id))->first();
		if ($items['items'] !== null) {
			$item['id']      = $id;
			$item['code']    = $index;
		}
		return view('Admin.widget.edit-widget', compact('item'));
	}
	public function updateWidget(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'code' => 'required|string|max:255',
				]);
			$items = Widget::findOrFail(Hashids::decode($request['id']))->first();
			if ($items['items'] !== null) {
				$item                   = unserialize($items['items']);
				$item[$request['code']] = $item[$request['index']];
                unset($item[$request['index']]);
                $product = Product::where('code',$request['code'])->first();
                if($product == null)
                {
                    return response()->json(['error'=>"محصول مورد نظر موجود نیست "]);
                }
				$item[$request['code']] = $product->name;
				$item                   = serialize($item);
				$items['items']         = $item;
				$items->save();
			}
			return response()->json(['success', $this->successStatus]);
		}
	}
	public function deleteWidget($id, $index) {
		$items = Widget::findOrFail(Hashids::decode($id))->first();
		if ($items['items'] !== null) {
			$item = unserialize($items['items']);
			unset($item[$index]);
			$item           = serialize($item);
			$items['items'] = $item;
			$items->save();
		}
		return redirect()->back();
	}

	public function deleteWidgets($id) {
		$items = Widget::findOrFail(Hashids::decode($id))->first();
		$items->delete();
		return redirect()->back();
	}

	public function editWidgets($id) {
		$item = Widget::findOrFail(Hashids::decode($id))->first();
		return view('Admin.widget.edit-widgets', compact('item'));
	}

	public function updateWidgets(Request $request, $id) {
		$this->validate($request, [
				'name' => 'required|string|max:255',
			]);
		$item         = Widget::findOrFail(Hashids::decode($id))->first();
		$item['name'] = $request['name'];
		$item->save();
		return response()->json(['success', $this->successStatus]);
	}
}
