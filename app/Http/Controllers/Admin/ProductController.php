<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\DiscountProduct;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductFeature;
use App\ProductItem;
use App\ProductOption;
use App\ProductPrice;
use App\SubCategory;
use Auth;
use DataTables;
use Hashids;
use Illuminate\Http\Request;
use Verta;

class ProductController extends Controller
{
    public $successStatus = 200;
    public function ProductList(Request $request)
    {
        return $request->ajax() ? view('Admin.ajax.product-list') : view('Admin.product.product-list');
    }
    public function productListGet(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('category')->select('id', 'code', 'name', 'price', 'status', 'category_id', 'available_num', 'slug');
            return Datatables::of($products)->addColumn('action', function ($product) {
                return '<div class="btn-group"><a class="btn btn-primary" href="' . route('product.edit', ['id' => $product->id]) . '">نمایش</a><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu"><li><a href="' . route('product.destroy', ['id' => $product->id]) . '" class="remove-product">حذف</a></li><li class="divider"></li><li><a href="' . route('product.edit', ['id' => $product->id]) . '">ویرایش</a></li><li class="divider"></li><li><a href="' . route('product.image.index', ['id' => Hashids::encode($product->id)]) . '">ویرایش تصاویر</a></li></ul></div>';
            })
                ->editColumn('status', '{{$status == 1 && $available_num > 0 ? "موجود" : "ناموجود"}}')
                ->make(true);
        }
    }
    public function selectProduct(Request $request)
    {
        $items = ProductItem::all();
        return $request->ajax() ? view('Admin.ajax.product-select-item', compact('items')) : view('Admin.product.product-select-item', compact('items'));
    }
    public function getItemProduct(Request $request)
    {
        return redirect()->route('product.index', ['id' => $request['itemId']]);
    }
    public function getSubcategory(Request $request, $id)
    {
        if ($request->ajax()) {
            $subs = SubCategory::select('id', 'name', 'slug')->where('category_id', Hashids::decode($id))->get();
            return response()->json($subs, 200);
        }
    }
    public function index(Request $request, $id)
    {
        $items = ProductItem::findOrFail(Hashids::decode($id))->first();
        $categories = Category::all();
        return view('Admin.product.insert-product', compact('items', 'categories'));
    }
    public function create(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'en_name' => 'string|max:255',
                'code' => 'required',
                'brand' => 'required|string|max:255',
                'price' => 'required|numeric',
                'vat' => 'numeric',
                'available_num' => 'required|numeric',
                'description' => 'required|string',
                'seo_description' => 'required|string',
                'seo_keyword' => 'required|string',
                'category' => 'required',
                'sub' => 'required',
                'tprice' => 'numeric',
            ]);

            if (!request()->hasFile('file') && $request["price"] < 100) {
                $error = ["برای کالا های فیزیکی قیمت باید بیشتر از ۱۰۰ تومان باشد!"];
                return response()->json(['0' => $error], 422);
            }
            if ($request['vat'] != null && $request['vat'] != 0 && $request["price"] != 0) {
                $vat = ($request['price'] * $request['vat']) / 100;
                $price = $request['price'] + $vat;
                $marketer_price = $request['marketer_price'] + $vat;
            } else {
                $price = $request['price'];
                $marketer_price = $request['marketer_price'];
            }
            $category = Hashids::decode($request['category']);
            $id = Hashids::decode($id);
            $product = new Product();
            $product->name = $request['name'];
            $product->en_name = $request['en_name'];
            $product->code = $request['code'];
            $product->brand = $request['brand'];
            $product->price = $request['price'];
            $product->marketer_price = $request['marketer_price'];
            $product->vat = $request['vat'];
            $product->available_num = $request['available_num'];
            $product->description = $request['description'];
            $product->seo_description = $request['seo_description'];
            $product->seo_keyword = $request['seo_keyword'];
            $product->category_id = $category[0];
            $product->subcategory_id = $request['sub'];
            $product->purchase_price = $request['purchase_price'];
            $product->item_id = $id[0];
            $product->status = $request->has('status') ? 1 : 0;
            $product->color = $request->has('color') ? 1 : 0;
            $product->suggest = $request->has('suggest') ? 1 : 0;
            $product->user_id = Auth::user()->id;
            // upload post files
            if (request()->hasFile('file')) {
                $filename = time() . '-' . $request->file->getClientOriginalName();
                $request->file->storeAs('public/upload/', $filename);
                $product->file = 'public/upload/' . $filename;
            }
            $product->save();
            if ($request['tags'] != null) {
                $product->tag($request['tags']);
            }
            ProductPrice::create(['product_id' => $product->id, 'price' => $price, 'marketer_price' => $marketer_price]);
            if ($request['items'] != null) {
                foreach (array_combine($request['items'], $request['values']) as $key => $value) {
                    if ($value != null) {
                        $feature = new ProductFeature;
                        $feature->product_id = $product->id;
                        $feature->item = $key;
                        $feature->value = $value;
                        $feature->save();
                    }
                }
            }
            /****
             * insert product Options
             */
            if (isset($request["optionName"]) && $request["price"] != 0) {
                for ($i = 0; $i < sizeof($request['optionName']); $i++) {
                    if ($request["optionName"][$i] != null && $request["optionValue"][$i] != null && $request["optionPrice"][$i] != null) {
                        ProductOption::create(['product_id' => $product->id, 'name' => $request["optionName"][$i], 'value' => $request["optionValue"][$i], 'price' => $request["optionPrice"][$i]]);
                    }
                }
            }
            if ($request->has('discount-type') && $request->has('discount-price') && $request->has('discount-start') && $request->has('discount-finish') && $request['price'] != 0) {
                if ($request['discount-type'] == 1) {
                    if ($request['discount-price'] != 0) {
                        $price = $price - (($price * $request['discount-price']) / 100);
                    }
                } else {
                    $price = $price - $request['discount-price'];
                }
                DiscountProduct::create(['type' => $request['discount-type'], 'price' => $price, 'product_id' => $product->id, 'started_at' => Verta::parse($request['discount-start'])->formatGregorian('Y-m-d H:i:s'), 'finished_at' => Verta::parse($request['discount-finish'])->formatGregorian('Y-m-d H:i:s'), 'tprice' => $request['discount-price']]);
            }
            $id = Hashids::encode($product->id);
            return $id;
        }
    }
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $items = ProductItem::findOrFail($product->item_id);
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $product['category_id'])->get();
        $features = ProductFeature::where('product_id', $product->id)->get();
        $options = ProductOption::where('product_id', $product->id)->get();
        $discount = DiscountProduct::where('product_id', $product->id)->first();
        return view('Admin.product.edit-product', compact('product', 'items', 'categories', 'options', 'subcategories', 'features', 'discount'));
    }
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'en_name' => 'string|max:255',
                'code' => 'required',
                'brand' => 'required|string|max:255',
                'price' => 'required|numeric',
                'vat' => 'numeric',
                'available_num' => 'required|numeric',
                'description' => 'required|string',
                'seo_description' => 'required|string',
                'seo_keyword' => 'required|string',
                'category' => 'required',
                'sub' => 'required',
                'tprice' => 'numeric',
            ]);
            if (!request()->hasFile('file') && $request["price"] < 100) {
                $error = ["برای کالا های فیزیکی قیمت باید بیشتر از ۱۰۰ تومان باشد!"];
                return response()->json(['0' => $error], 422);
            }
            if ($request['vat'] != null && $request['vat'] != 0 && $request["price"] != 0) {
                $vat = ($request['price'] * $request['vat']) / 100;
                $price = $request['price'] + $vat;
                $marketer_price = $request['marketer_price'] + $vat;
            } else {
                $price = $request['price'];
                $marketer_price = $request['marketer_price'];
            }
            $category = Hashids::decode($request['category']);
            $product = Product::where('id', $id)->first();
            $product->name = $request['name'];
            $product->en_name = $request['en_name'];
            $product->code = $request['code'];
            $product->brand = $request['brand'];
            $product->price = $request['price'];
            $product->marketer_price = $request['marketer_price'];
            $product->vat = $request['vat'];
            $product->available_num = $request['available_num'];
            $product->description = $request['description'];
            $product->seo_description = $request['seo_description'];
            $product->seo_keyword = $request['seo_keyword'];
            $product->purchase_price = $request['purchase_price'];
            $product->category_id = $category[0];
            $product->subcategory_id = $request['sub'];
            $product->status = $request->has('status') ? 1 : 0;
            $product->color = $request->has('color') ? 1 : 0;
            $product->suggest = $request->has('suggest') ? 1 : 0;
            $product->slug = null;
            // upload post files
            if (request()->hasFile('file')) {
                $filename = time() . '-' . $request->file->getClientOriginalName();
                $request->file->storeAs('public/upload/', $filename);
                $product->file = 'public/upload/' . $filename;
            }
            $product->save();
            if ($request['tags'] != null) {
                $product->retag($request['tags']);
            } else {
                $product->detag();
            }
            ProductPrice::where('product_id', $product->id)->update(['price' => $price, 'marketer_price' => $marketer_price]);
            $i = 0;
            if ($request['items'] != null) {
                foreach (array_combine($request['items'], $request['values']) as $key => $value) {
                    $query = ProductFeature::where('item', $key)->where('product_id', $product->id)->first();
                    if ($query == null) {
                        if ($value != null) {
                            $feature = new ProductFeature;
                            $feature->product_id = $product->id;
                            $feature->item = $key;
                            $feature->value = $value;
                            $feature->save();
                        }
                    } else {
                        $query->value = $value;
                        $query->save();
                    }
                }
            }
            /**
             * insert product Options
             */
            ProductOption::where('product_id', $product->id)->delete();
            if (isset($request["optionName"]) && $request["price"] != 0) {
                for ($i = 0; $i < sizeof($request['optionName']); $i++) {
                    if ($request["optionName"][$i] != null && $request["optionValue"][$i] != null && $request["optionPrice"][$i] != null) {
                        ProductOption::create(['product_id' => $product->id, 'name' => $request["optionName"][$i], 'value' => $request["optionValue"][$i], 'price' => $request["optionPrice"][$i]]);
                    }
                }
            }
            if (Discountproduct::where('product_id', $product->id)) {
                $discount = DiscountProduct::where('product_id', $product->id);
                $discount->delete();
            }
            if ($request->has('discount-type') && $request->has('discount-price') && $request->has('discount-start') && $request->has('discount-finish') && $request["price"] != 0) {
                if ($request['discount-type'] == 1) {
                    if ($request['discount-price'] != 0) {
                        $price = $price - (($price * $request['discount-price']) / 100);
                    }
                } else {
                    $price = $price - $request['discount-price'];
                }
                Discountproduct::create(['type' => $request['discount-type'], 'price' => $price, 'product_id' => $product->id, 'started_at' => Verta::parse($request['discount-start'])->formatGregorian('Y-m-d H:i:s'), 'finished_at' => Verta::parse($request['discount-finish'])->formatGregorian('Y-m-d H:i:s'), 'tprice' => $request['discount-price']]);
            }
            return response()->json(['success', $this->successStatus]);
        }
    }
    public function itemDelete(Request $request, $id)
    {
        $feature = ProductFeature::findOrFail($id);
        $feature->delete();
        return response()->json(['success', $this->successStatus]);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }

    public function insertNew(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'en_name' => 'string|max:255',
            'code' => 'required',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'vat' => 'numeric',
            'available_num' => 'required|numeric',
            'description' => 'required|string',
            'seo_description' => 'required|string',
            'seo_keyword' => 'required|string',
            'category' => 'required',
            'sub' => 'required',
            'tprice' => 'numeric',
        ]);

        if ($request['vat'] != null && $request['vat'] != 0 && $request["price"] != 0) {
            $vat = ($request['price'] * $request['vat']) / 100;
            $price = $request['price'] + $vat;
            $marketer_price = $request['marketer_price'] + $vat;
        } else {
            $price = $request['price'];
            $marketer_price = $request['marketer_price'];
        }
        $category = Hashids::decode($request['category']);
        $id = Hashids::decode($id);
        $product = new Product();
        $product->name = $request['name'];
        $product->en_name = $request['en_name'];
        $product->code = $request['code'];
        $product->brand = $request['brand'];
        $product->price = $request['price'];
        $product->marketer_price = $request['marketer_price'];
        $product->vat = $request['vat'];
        $product->available_num = $request['available_num'];
        $product->description = $request['description'];
        $product->seo_description = $request['seo_description'];
        $product->seo_keyword = $request['seo_keyword'];
        $product->category_id = $category[0];
        $product->subcategory_id = $request['sub'];
        $product->purchase_price = $request['purchase_price'];
        $product->item_id = $id[0];
        $product->status = $request->has('status') ? 1 : 0;
        $product->color = $request->has('color') ? 1 : 0;
        $product->user_id = 1;

        $product->save();
        if ($request['tags'] != null) {
            $product->tag($request['tags']);
        }

        ProductPrice::create(['product_id' => $product->id, 'price' => $price, 'marketer_price' => $marketer_price]);
        if ($request['items'] != null) {
            foreach (array_combine($request['items'], $request['values']) as $key => $value) {
                if ($value != null) {
                    $feature = new ProductFeature;
                    $feature->product_id = $product->id;
                    $feature->item = $key;
                    $feature->value = $value;
                    $feature->save();
                }
            }
        }

        $id = Hashids::encode($product->id);
        return $id;
    }
}
