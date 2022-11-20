<?php

namespace App\Http\Controllers\Front;
use App\Cart;
use App\Category;
use App\DiscountCode;
use App\DiscountProduct;
use App\Http\Controllers\Controller;
use App\Option;
use App\Product;
use App\SubCategory;
use Carbon;
use Crypt;
use Illuminate\Http\Request;
use Input;
use Session;

class ProductController extends Controller {
	/**
	 * [index description]
	 * @param  [type] $slug [description  ]
	 * @return [type]       [description]
	 */
	public function index($slug) {
		\Counter::count('product.show',$slug);
		$product  = Product::findBySlug($slug);
		$products = Product::where('category_id', $product->category_id)->where('subcategory_id', $product->subcategory_id)->orWhere('name','like','%'.$product->name.'%')->take(6)->get();
		return view('Front.product.product', compact('product', 'products'));

	}
	/**
	 * [all description]
	 * @return [type] [description]
	 */
	public function all() {
		// return Input::get('sort');
		$subcategories = Subcategory::all();
		$brands        = Product::select('brand')->groupBy('brand')->get();
		$products      = Product::orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
		$count         = Product::orderBy('price', 'ASC')->orderBy('vat', 'ASC')->count();
		$min           = Product::orderBy('price', 'ASC')->orderBy('vat', 'ASC')->min("price");
		$max           = Product::orderBy('price', 'ASC')->orderBy('vat', 'ASC')->max("price");
		return view('Front.product.product-list', compact('products', 'subcategories', 'brands', 'count', 'max', 'min'));
	}
	/**
	 * [category description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function category($slug) {
		\Counter::count('product.category',$slug);
		$category            = Category::findBySlug($slug);
		$subcategory['name'] = "";
		$subcategories       = Subcategory::where('category_id', $category->id)->get();
		$brands              = Product::select('brand')->where('category_id', $category->id)->groupBy('brand')->get();
		$products            = Product::where('category_id', $category->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
		$count               = Product::where('category_id', $category->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->count();
		$min                 = Product::where('category_id', $category->id)->min("price");
		$max                 = Product::where('category_id', $category->id)->max("price");
		return view('Front.product.product-list', compact('products', 'category', 'subcategory', 'subcategories', 'brands', 'count', 'max', 'min'));
	}
	/**
	 * [subcategory description]
	 * @param  [type] $slug [description]
	 * @param  [type] $sub  [description]
	 * @return [type]       [description]
	 */
	public function subcategory($slug, $sub) {
		\Counter::count('product.subcategory',$slug,$sub);
		$category      = Category::findBySlug($slug);
		$subcategory   = SubCategory::findBySlug($sub);
		$subcategories = Subcategory::where('category_id', $category->id)->get();
		$brands        = Product::select('brand')->where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->groupBy('brand')->get();
		$products      = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
		$count         = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->count();
		$min           = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->min("price");
		$max           = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->max("price");
		return view('Front.product.product-list', compact('products', 'category', 'subcategory', 'subcategories', 'brands', 'count', 'max', 'min'));
	}
	/**
	 * [sort_filter description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function filter($category) {
		$range = Input::has('range')?Input::get('range'):null;
		if (isset($range)) {
			$range = explode(";", $range);
		}
		$sort = Input::has('sort')?Input::get('sort'):"cheap";
		if (isset($sort)) {
			if ($sort == "cheap") {
				$order = "ASC";
				$model = "price";
			}

			if ($sort == "expensive") {
				$order = "DESC";
				$model = "price";
			}
			if ($sort == "news") {
				$order = "DESC";
				$model = "created_at";
			}

			//dd($order, $model);

		}
		if (isset($range)) {
			$products = Product::where('category_id', $category)->where(function ($query) {
					$brands = Input::has('brand')?Input::get('brand'):null;
					$subcategories = Input::has('subcategory')?Input::get('subcategory'):null;

					if (isset($brands)) {
						foreach ($brands as $brand) {
							$query->orWhere('brand', '=', $brand);
						}
					}
					if (isset($subcategories)) {
						foreach ($subcategories as $sub) {
							$query->orWhere('subcategory_id', '=', $sub);
						}
					}
				})->WhereBetween("price", [($range[0]), ($range[1])])->orderBy($model, $order)->get();
		} else {
			$products = Product::where('category_id', $category)->where(function ($query) {
					$brands = Input::has('brand')?Input::get('brand'):null;
					$subcategories = Input::has('subcategory')?Input::get('subcategory'):null;

					if (isset($brands)) {
						foreach ($brands as $brand) {
							$query->orWhere('brand', '=', $brand);
						}
					}
					if (isset($subcategories)) {
						foreach ($subcategories as $sub) {
							$query->orWhere('subcategory_id', '=', $sub);
						}
					}
				})->orWhereBetween("price", [($range[0]), ($range[1])])->orderBy($model, $order)->get();
		}
		$categories = array();
		if (Input::has('subcategory')) {
			foreach (Input::get('subcategory') as $sub) {
				$temp = Subcategory::where("id", $sub)->first();
				array_push($categories, $temp->name);
			}
		}
		$max = Product::where('category_id', $category)->get()->max('price');
		$min = Product::where('category_id', $category)->get()->min('price');
		return view('Front.product.product-filter', compact('products', 'categories', 'max', 'min'));
	}

	public function takhfif() {
		$discount = DiscountProduct::where('started_at', '<=', Carbon\Carbon::today())->where('finished_at', '>=', Carbon\Carbon::today())->pluck('product_id')->toArray();
		;
		$products = Product::whereIn('id', $discount)->get();
		return view('Front.product.product-takhfif', compact('products'));
	}
	/**
	 * [getAddToCart description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function getAddToCart(Request $request, $id) {
		$product                                                          = Product::find($id);
		$color                                                            = $request->has('color')?$request['color']:"null";
		$option                                                           = $request->has('option')?$request['option']:"null";
		if ($request->has('color')) {if ($request['color'] == "") {$color = "null";}}
    $id =$product->id."_".$color."_".$option;
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		if($oldCart != null &&  array_key_exists($id,$oldCart->items))
		{
			if((int)$oldCart->items[$id]["qty"]+1 > $product->available_num )
			{
				return response()->json([[0=>"محصول مورد نظر موجود نمی باشد"]],402);
			}
		}
		if($product->available_num == 0)
		{
			return response()->json([[0=>"محصول مورد نظر موجود نمی باشد"]],402);
		}
		$cart    = new Cart($oldCart);
		$cart->add($product, $product->id, $color, $option);
		$request->session()->put('cart', $cart);
		return "ok";
	}
	public function getplusToCart(Request $request, $id) {
		$key     = Crypt::decrypt($id);
		$id      = explode("_", Crypt::decrypt($id));
		$product = Product::find($id[0]);
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart    = new Cart($oldCart);
		if($oldCart != null  && array_key_exists($key,$oldCart->items))
		{
			$cart =Session::get('cart');
			if((int)$cart->items[$key]["qty"]+1 > $product->available_num )
			{
				return redirect()->back()->with('error',"محصول مورد نظر موجود نمی باشد");
			}
		}
		$cart->add($product, $product->id, $id[1], $id[2]);
		$request->session()->put('cart', $cart);
		return redirect()->route('product.shoppingCart');
	}
	public function getReduceByOne($id) {
		$id      = Crypt::decrypt($id);
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart    = new Cart($oldCart);
		$cart->reduceByOne($id);
		if (count($cart->items) > 0) {
			Session::put('cart', $cart);
		} else {
			Session::forget('cart');
			Session::forget('discount');
		}
		return redirect()->route('product.shoppingCart');
	}
	public function getRemoveItem($id) {
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart    = new Cart($oldCart);
		$id      = Crypt::decrypt($id);
		$cart->removeItem($id);
		if (count($cart->items) > 0) {
			Session::put('cart', $cart);
		} else {
			Session::forget('cart');
			Session::forget('discount');
		}
		return redirect()->route('product.shoppingCart');
	}
	public function getCart() {
		if (!Session::has('cart')) {
			return view('Front.cart.cart');
		}
		$oldCart  = Session::get('cart');
		$cart     = new Cart($oldCart);
		$products = array();
		foreach ($cart->items as $index => $value) {
			$ids            = explode("_", $index);
			$product        = Product::find($ids[0]);
			$item['id']     = Crypt::encrypt($index);
			$item['brand']  = $product->brand;
			$item['name']   = $product->name;
			$item['color']  = $ids[1];
			$item['option'] = $ids[2];
			$item['image']  = $product->images()->first()->link;
			$item['qty']    = $value['qty'];
			$item['price']  = $value['price'];
			if ($ids[2] != "null") {
				$option              = Option::find($ids[2]);
				$item['price']       = $item['price']+($option->price*$value['qty']);
				$item['option']      = $option->name."-----".$option->price;
				$cart->totalPrice    = $cart->totalPrice+($option->price*$value['qty']);
				$item['optionprice'] = $option->price;
			} else {
				$item['option'] = "null";
			}
			array_push($products, $item);
		}
		return view('Front.cart.cart', ['products' => $products, 'totalPrice' => $cart->totalPrice]);
	}

	public function discount_check(Request $request) {
		$this->validate($request, ['discountcode' => 'required']);
		$error = [];
		$code  = DiscountCode::where('code', $request["discountcode"])->where('status', 1)->first();
		if ($code == null) {
			return response()->json($data = [["کد اعمال شده اشتباه میباشد"]], 422);
		} elseif ($code   ->expire_at <= Carbon\Carbon::today()) {
			return response()->json($data = [["کد اعمال شده منقضی شده است"]], 422);
		} elseif (Session::has('discount')) {
			return response()->json($data = [["یکبار کد تخفیف برای این سفارش اعمال شده است"]], 422);
		} else {
			$request->session()->put('discount', $code);
			if ($code->type == 1) {
				$massage = $code->price." درصد";
			} else {
				$massage = $code->price." هزار تومان";
			}
			return response()->json(["massage" => "کد تخفیف با موفقیت اعمال شد و به میزان ".$massage."در فاکتور نهایی برای شما تخفیف داده خواهد شد!"], 200);
		}

	}
//---------------------------------------------
/**
 * Search method
 * user Get Route and give  search variable
 */

 public function search(){
	 if(Input::has('search'))
	 {
		 $search = Input::get('search');
		 $products = Product::where('name', 'like', '%' . $search . '%')->orWhere('en_name', 'like', '%' . $search . '%')->orWhere('brand', 'like', '%' . $search . '%')->get();
		 return view('Front.search.search',compact('search','products'));
	 }
	 else{
		 $search = "";
		 $products=[];
		 return view('Front.search.search',compare('search','products'));
	 }
 }
}
