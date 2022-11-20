<?php
namespace App;
use Auth;
use Carbon;
class Cart {
	public $items      = null;
	public $totalQty   = 0;
	public $totalPrice = 0;
	public function __construct($oldCart) {
		if ($oldCart) {
			$this->items      = $oldCart->items;
			$this->totalQty   = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	public function add($item, $id, $color, $option) {
		$id         = $id."_".$color."_".$option;
		$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		if (!Auth::guest() && Auth::user()->can('visitor')) {
			$product_price = $item->marketer_price;
		} else {
			if(isset($item->discountproduct[0]->price)  && $item->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $item->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$product_price = $item->discountproduct[0]->price;

			}else{
				$product_price = $item->price;
			}

		}
		$storedItem['qty']++;
		$storedItem['price'] = $product_price*$storedItem['qty'];
		$this->items[$id]    = $storedItem;
		$this->totalQty++;
		$this->totalPrice += $product_price;
	}
	public function reduceByOne($id) {
		// if (!Auth::guest() && Auth::user()->can('visitor')) {
		// 	$product_price = $this->items[$id]['item']['marketer_price'];
		// } else {
		// 	$product_price = $this->items[$id]['item']['price'];
		// }
		$price = $this->items[$id]['price'] / $this->items[$id]['qty'];
		$this->items[$id]['price'] -= $price;
			$this->items[$id]['qty']--;
		$this->totalQty--;
		$this->totalPrice -= $price;
		if ($this->items[$id]['qty'] <= 0) {
			unset($this->items[$id]);
		}
	}
	public function removeItem($id) {
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
