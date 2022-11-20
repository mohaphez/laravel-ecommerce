<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slideshow;
use App\SubCategory;
use DB;
use Input;
use Carbon;
use App\DiscountProduct;
use App\Product;

class ShopController extends Controller {
	public function categories() {
		$categories = Category::select('name', 'slug','image')->get();

		return response()->json($categories, 200);
	}

	public function subcategories($slug) {
		$category   = Category::findBySlug($slug);
		// $categories = Subcategory::select('name', 'slug')->with('category->slug')->where('category_id', $category->id)->get();
		$categories = DB::table('categories')
        ->join('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
        ->select('sub_categories.name','sub_categories.slug',DB::raw('categories.slug as pre_slug'))
        ->where('sub_categories.category_id', $category->id)
		->get();
		$arrays =  Product::where('category_id', $category->id)->take(50)->get();
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			*/
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			*/
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;


			array_push($products,$item);
		}
		return response()->json(['subcategory'=>$categories,'products'=>$products], 200);
	}

	public function products($c_slug, $s_slug) {
		$category    = Category::findBySlug($c_slug);
		$subcategory = SubCategory::findBySlug($s_slug);
		$arrays =  Product::where('category_id', $category->id)->where('subcategory_id',$subcategory->id)->take(50)->get();;
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			*/
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			*/
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;

			array_push($products,$item);
		}
		return response()->json($products, 200);
	}

	/**
	 * 
	 * a category products 
	 */
	public function category_products($c_slug) {
		$category    = Category::findBySlug($c_slug);
		$arrays =  Product::where('category_id', $category->id)->take(50)->get();;
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			*/
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			*/
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;

			array_push($products,$item);
		}
		return response()->json($products, 200);
	}

	public function slideshows() {
		$slide = Slideshow::all();

		return response()->json($slide);
	}

	public function discount_products() {
		$arrays =  DiscountProduct::where('started_at' ,'<=',  Carbon\Carbon::today())->where('finished_at' ,'>=' ,  Carbon\Carbon::today())->get();
		$products = array();
		foreach($arrays as $array){
			$product = Product::find($array->product_id);
			$item = array();
			/**
			 * check product  have image or no 
			*/
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;
			/**
			 * if check product have  discount or null 
			*/
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
				array_push($products,$item);
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
		}
		return response()->json($products, 200);
	}

	public function suggest() {
		$arrays =  Product::where('suggest',1)->get();
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			 */
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			 */
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;

			array_push($products,$item);
		}
		return response()->json($products, 200);
	}

	public function lastItem() {
		$arrays =  Product::take(24)->orderBy('updated_at','ASC')->get();
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			 */
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			 */
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;

			array_push($products,$item);
		}
		return response()->json($products, 200);
	}
	/**
	 * application  search  method 
	 */
	public function search(Request $request){
		if(Input::get("q") != null)
		{
		$arrays =  Product::where('name', 'like', '%' . Input::get('q') . '%')->orWhere('brand', 'like', '%' . Input::get('q') . '%')->get();
		$products = array();
		foreach($arrays as $product){
			$item = array();
			/**
			 * if check product have  discount or null 
			 */
			if(isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <=  Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >=  Carbon\Carbon::today())
			{
				$item["price"] = $product->discountproduct[0]->price;
				$item["tprice"]  = $product->price()->price;
			}else{
				$item["price"]  = $product->price()->price;
				$item["tprice"] = "null";
			}
			/**
			 * check product  have image or no 
			 */
			if($product->images() != "[]")
			{
				$item["link"] = $product->images()->first()->link;
			}else{
				$item["link"] = '/photos/1/Princely/Trimmer/462.jpg';
			}
			$item["id"] = $product->id;
			$item["name"] = $product->name;
			$item["brand"] = $product->brand;
			//$item["description"] = $product->description;

			array_push($products,$item);
		}
		return response()->json($products, 200);
	}else{
		return response()->json(['error' => 'کلمه ای برای جستجو دریافت نشد !'], 401);
	}  
	}
}
