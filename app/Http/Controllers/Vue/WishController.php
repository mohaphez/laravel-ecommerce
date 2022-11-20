<?php

namespace App\Http\Controllers\Vue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wishlist;
use App\Product;
use Auth;

class WishController extends Controller
{
    public function WishList(){
        $products = Wishlist::where('user_id',Auth::user()->id)->select('product_id')->get();
        $wishlists = array();
        foreach($products as $product)
        {
            $temp = null ; 
            $temp = Product::ProductItem('id',$product->product_id);
            array_push($wishlists,$temp);
        }
        return response()->json(['wishlists'=>$wishlists]);
    }

    public function WishStore($slug){
        $product = Product::where('slug',$slug)->first();
        if($product != null)
        { 
          $check = Wishlist::where('product_id',$product->id)->where('user_id',Auth::user()->id)->first();
          if($check)
          {
              $check->delete();
              return response()->json(['message'=>'از لیست علاقه مندی های شما حذف شد','status'=> 0],200);
          }
          WishList::create(['user_id'=>Auth::user()->id,'product_id'=>$product->id]);
          return response()->json(['message'=>' به لیست علاقه مندی های شما اضافه شد!','status'=>1],200);
        }
         else
           return response()->json(['message'=>'محصول مورد نظر موجود نیست'],422);
    }

    public function WishRemove($slug){
        $product = Product::where('slug',$slug)->first();
        $wishproduct = Wishlist::where('product_id',$product->id)->where('user_id',Auth::user()->id)->first();
        if($wishproduct != null)
        { 
          $wishproduct ->delete();
          return response()->json(['message'=>'محصول از لیست شما حذف شد'],200);
        }
         else
           return response()->json(['message'=>'متاسفانه دسترسی ندارید!'],422);
    }
}
