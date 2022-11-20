<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\Setting;
use Hashids;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $query = Product::findOrFail(Hashids::decode($id))->first();
        $product['code'] = $query->code;
        $product['id'] = $query->id;
        $images = ProductImage::where('product_id', Hashids::decode($id))->get();
        return $request->ajax() ? view('Admin.ajax.product-image', compact('product', 'images')) : view('Admin.product.product-image', compact('product', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($request->ajax()) {
            $product_id = Product::findOrFail(Hashids::decode($id))->first();
            if ($product_id->color == 1) {
                $this->validate($request, [
                    'color' => 'required|string|max:255',
                    'alt' => 'required',
                    'filepath' => 'required',
                ]);
            } else {
                $this->validate($request, [
                    'alt' => 'required',
                    'filepath' => 'required',
                ]);
            }
            /**
             * Send Product to telegram channel
             */
            $check = ProductImage::where('id', $id)->first();
            $domain = Setting::first();
            if ($check == null) {
                $cfile = new \CURLFile(realpath(public_path($request['filepath'])));

                $message = "نام محصول :" . $product_id->name . "\n " . "قیمت محصول :" . $product_id->price()->price . " تومان \n \n" . "لینک محصول: http://" . $domain->domain . "/product/" . $product_id->slug . " \n @shop";
                $data = [
                    'chat_id' => '@shop',
                    'photo' => $cfile,
                    'caption' => $message,
                ];
                $apiKey = Setting::first()->tel_bot_api;
                $bot_url = "https://api.telegram.org/$apiKey";
                $url = $bot_url . "sendPhoto?chat_id=@shop";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type:multipart/form-data",
                ));
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $output = curl_exec($ch);
            }
            /**
             * Save image
             */
            $image = new ProductImage();
            $image->link = $request['filepath'];
            $image->description = $request['alt'];
            $image->color = $request['color'];
            $image->product_id = $product_id->id;
            $image->save();
            return response()->json(['success', $this->successStatus]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $product_id = Product::findOrFail(Hashids::decode($id))->first();
            if ($product_id->color == 1) {
                $this->validate($request, [
                    'color' => 'required|string|max:255',
                    'alt' => 'required',
                    'filepath' => 'required',
                ]);
            } else {
                $this->validate($request, [
                    'alt' => 'required',
                    'filepath' => 'required',
                ]);
            }

            $image = ProductImage::findOrFail(Hashids::decode($request['id']))->first();
            $image->link = $request['filepath'];
            $image->description = $request['alt'];
            $image->color = $request['color'];
            $image->product_id = $product_id->id;
            $image->save();
            return response()->json(['success', $this->successStatus]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProductImage::where('id', $id)->first();
        $image->delete();
        return redirect()->back();
    }
}
