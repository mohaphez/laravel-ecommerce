<?php

namespace App\Http\Controllers\Vue;

use App\Baner;
use App\BlogCategory;
use App\Brand;
use App\Category;
use App\DiscountProduct;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Page;
use App\Post;
use App\Product;
use App\ProductComment;
use App\Setting;
use App\Slideshow;
use App\SubCategory;
use App\Widget;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Input;

class PagesWidgetController extends Controller
{
    protected $defaultImage = '/uploads/photos/default.png';

    public function homePage()
    {

        /**
         * Slideshows Array
         */
        $slides = Slideshow::all();

        /**
         * Discount Products Send
         */
        $arrays = DiscountProduct::where('started_at', '<=', Carbon::today())->where('finished_at', '>=', Carbon::today())->get();
        $discounts = array();
        foreach ($arrays as $array) {
            $item = array();
            $item = Product::productItem('id', $array->product_id);
            array_push($discounts, $item);
        }

        /**
         * Send CategoryWidget Arrays
         */
        $categoryWidget = array();
        $arrays = Category::take(3)->get();
        foreach ($arrays as $array) {
            $item = null;
            $item["name"] = $array->name;
            $item["slug"] = $array->slug;
            $item["image1"] = $array->image ?? $this->defaultImage;
            $item["price"] = Product::where('category_id', $array->id)->select("price")->min("price");
            $product = Product::where('category_id', $array->id)->inRandomOrder()->first();
            if ($product) {
                if ($product->images() != "[]") {
                    $item["image2"] = $product->images()->first()->link;
                } else {
                    $item["image2"] = $this->defaultImage;
                }
            }
            if ($product) {
                $product = Product::where('category_id', $array->id)->inRandomOrder()->first();
                if ($product->images() != "[]") {
                    $item["image3"] = $product->images()->first()->link;
                } else {
                    $item["image3"] = $this->defaultImage;
                }
            }
            array_push($categoryWidget, $item);
        }

        /**
         * send All Categories
         */
        $categories = Category::with('subcategory')->get();

        /**
         * Lasetd productes
         */
        $arrays = Product::take(15)->get();
        $lastProducts = array();
        foreach ($arrays as $array) {
            $item = null;
            $item = Product::productItem('id', $array->id);
            array_push($lastProducts, $item);
        }
        /**
         * baners List
         */
        $i = 1;
        $baners = array();
        while ($i <= 7) {
            $item = null;
            $item = Baner::select('link', 'url', 'title', 'position', 'alt', 'status')->where('position', $i)->first();
            array_push($baners, $item);
            $i++;
        }

        /**
         *
         *ٌ Widgets  Arrays
         */
        $items = array();
        $products = array();
        $widgets = array();
        $arrays = Widget::all();
        foreach ($arrays as $array) {
            $products = [];
            $items = null;
            $items["name"] = $array->name;
            $temps = unserialize($array->items);
            foreach ($temps as $index => $value) {
                $product = null;
                $product = Product::productItem('code', $index);
                array_push($products, $product);
            }
            $items["products"] = $products;
            array_push($widgets, $items);
        }

        /**
         * Brands array
         */
        $brands = Brand::select('name', 'image')->get();

        return response()->json(["slides" => $slides, "discounts" => $discounts, "categoryWidget" => $categoryWidget, 'categories' => $categories, 'lastProducts' => $lastProducts, 'baners' => $baners, 'widgets' => $widgets, 'brands' => $brands], 200);
    }

    /**
     * Web app Setting such as menu links and footer info
     */
    public function settings(Request $request)
    {
        $menus = Menu::with('menuheader.submenu')->get();
        $header["menus"] = $menus;
        $setting["header"] = $header;
        $setting["siteinfo"] = Setting::select('perfix', 'name', 'logo', 'description', 'keyword', 'contact_email', 'contact_number', 'contact_address', 'google_code', 'alexa_code', 'setad_code', 'etemad_code', 'senf_code', 'about', 'roles', 'faq', 'agency', 'telegram', 'instagram', 'aparat')->first();
        $blog = Post::select('id', 'title')->take(6)->get();

        return response()->json(['setting' => $setting, 'blog' => $blog], 200);
    }

    /**
     * return Product Deteail
     */
    public function productPage($slug)
    {
        $product = Product::productdetail($slug);
        $item = Product::where('slug', $slug)->first();
        $arrays = Product::where('category_id', $item->category_id)->where('subcategory_id', $item->subcategory_id)->inRandomOrder()->take(7)->get();
        $relations = array();
        foreach ($arrays as $array) {
            $item = null;
            $temp = Product::productItem('id', $array->id);
            array_push($relations, $temp);
        }
        return response()->json(['product' => $product, 'relations' => $relations]);
    }
    /**
     * Store Comment For Products
     */
    public function commentStore(Request $request, $slug)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'comment' => 'required|string',
        ]);

        $product = Product::where('slug', $slug)->first();
        ProductComment::create(['title' => $request->title, 'comment' => $request->comment, 'like' => $request->like, 'product_id' => $product->id, 'user_id' => Auth::user()->id, 'status' => 0]);

        return response()->json(['message' => ' نظر شما با موفقیت ثبت شد پس از تایید مدیریت نمایش داده خواهد شد'], 200);
    }

    /**
     * Products show Page Base on Category and SubCategory Slug
     *
     */
    public function categoryProduct($slug)
    {
        \Counter::count('product.category', $slug);
        $category = Category::findBySlug($slug);
        if ($category == null) {
            return response()->json(['message' => 'متاسفانه اشتباه میزنید:)'], 422);
        }

        $subcategories['name'] = "";
        $subcategories = Subcategory::where('category_id', $category->id)->select('name', 'slug', 'id')->get();
        $brands = Product::select('brand')->where('category_id', $category->id)->groupBy('brand')->get();
        $products = Product::where('category_id', $category->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
        $count = Product::where('category_id', $category->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->count();
        $min = Product::where('category_id', $category->id)->min("price");
        $max = Product::where('category_id', $category->id)->max("price");
        $products->getCollection()->transform(function ($item) {
            $product = Product::productItem('id', $item->id);
            return $product;
        });

        return response()->json(['subcategory' => $subcategories, 'brands' => $brands, 'products' => $products, 'min' => $min, 'max' => $max, 'count' => $count]);

    }

    public function subcategoryProduct($slug, $sub)
    {
        \Counter::count('product.subcategory', $slug, $sub);
        $category = Category::findBySlug($slug);
        $subcategory = SubCategory::findBySlug($sub);
        if ($category == null || $subcategory == null) {
            return response()->json(['message' => 'متاسفانه اشتباه میزنید:)'], 422);
        }

        $subcategories = Subcategory::where('category_id', $category->id)->select('name', 'slug', 'id')->get();
        $brands = Product::select('brand')->where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->groupBy('brand')->get();
        $products = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
        $count = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->count();
        $min = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->min("price");
        $max = Product::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->max("price");

        $products->getCollection()->transform(function ($item) {
            $product = Product::productItem('id', $item->id);
            return $product;
        });

        return response()->json(['subcategory' => $subcategories, 'brands' => $brands, 'products' => $products, 'min' => $min, 'max' => $max, 'count' => $count]);

        return response()->json(['subcategory' => $subcategory, 'brands' => $brands, 'products' => $products, 'min' => $min, 'max' => $max, 'count' => $count]);
    }

    /**
     * Filter products
     */
    public function filterProduct(Request $request, $category)
    {
        $minPrice = $request->has('minPrice') ? $request->get('minPrice') : null;
        $maxPrice = $request->has('maxPrice') ? $request->get('maxPrice') : null;
        $category = Category::findBySlug($category)->id;
        $sort = Input::has('sort') ? Input::get('sort') : "cheap";
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
        }
        if ($minPrice != null && $maxPrice != null) {
            $products = Product::where('category_id', $category)->where(function ($query) use ($request) {
                $brands = $request->get('brand');
                $subcategories = $request->get('subcategory');
                if ($brands != []) {
                    foreach ($brands as $brand) {
                        $query->orWhere('brand', '=', $brand);
                    }
                }
                if ($subcategories != []) {
                    foreach ($subcategories as $sub) {
                        $query->orWhere('subcategory_id', '=', $sub);
                    }
                }
            })->WhereBetween("price", [$minPrice, $maxPrice])->orderBy($model, $order)->get();
            $items = array();
            $data = array();
            foreach ($products as $product) {
                $temp = null;
                $temp = Product::productItem('id', $product->id);
                array_push($data, $temp);
            }
            $items["data"] = $data;
        } else {
            $products = Product::where('category_id', $category)->where(function ($query) use ($request) {

                $brands = $request->get('brand');
                $subcategories = $request->get('subcategory');
                if ($brands != []) {
                    foreach ($brands as $brand) {
                        $query->orWhere('brand', '=', $brand);
                    }
                }
                if ($subcategories != []) {
                    foreach ($subcategories as $sub) {
                        $query->orWhere('subcategory_id', '=', $sub);
                    }
                }
            })->orderBy($model, $order)->get();
            $items = array();
            $data = array();
            foreach ($products as $product) {
                $temp = null;
                $temp = Product::productItem('id', $product->id);
                array_push($data, $temp);
            }
            $items["data"] = $data;
        }
        $categories = array();
        if ($request->has('subcategory')) {
            foreach ($request->subcategory as $sub) {
                $temp = Subcategory::where("id", $sub)->first();
                array_push($categories, $temp->name);
            }
        }
        $max = Product::where('category_id', $category)->get()->max('price');
        $min = Product::where('category_id', $category)->get()->min('price');
        return response()->json(['products' => $items, 'min' => $min, 'max' => $max]);
    }

    /**
     * Return All Categoriyes  and Brands
     */
    public function CategoryPage()
    {
        $categories = array();
        $arrays = Category::all();
        foreach ($arrays as $array) {
            $item = null;
            $item["name"] = $array->name;
            $item["slug"] = $array->slug;
            $item["image1"] = $array->image ?? $this->defaultImage;
            $item["price"] = Product::where('category_id', $array->id)->select("price")->min("price");
            $product = Product::where('category_id', $array->id)->inRandomOrder()->first();
            if ($product && $product->images() != "[]") {
                $item["image2"] = $product->images()->first()->link;
            } else {
                $item["image2"] = $this->defaultImage;
            }
            $product = Product::where('category_id', $array->id)->inRandomOrder()->first();
            if ($product && $product->images() != "[]") {
                $item["image3"] = $product->images()->first()->link;
            } else {
                $item["image3"] = $this->defaultImage;
            }
            array_push($categories, $item);
        }
        $brands = \DB::table('products')
            ->select('brand', DB::raw('count(*) as total'))
            ->groupBy('brand')
            ->get();
        return response()->json(['categories' => $categories, 'brands' => $brands], 200);
    }

    /**
     * Show Products By Brand name
     */
    public function BrandPage($slug)
    {
        $products = Product::where('brand', $slug)->orderBy('price', 'ASC')->orderBy('vat', 'ASC')->paginate(12);
        $count = Product::where('brand', $slug)->count();
        $products->getCollection()->transform(function ($item) {
            $product = Product::productItem('id', $item->id);
            return $product;
        });
        return response()->json(['products' => $products, 'count' => $count]);

    }

    /**
     * Return All Posts
     */
    public function BlogPostPage($slug)
    {
        if ($slug == "all") {
            $arrays = Post::paginate(10);
        } else {
            $category = Category::findBySlug($slug);
            if ($category == null) {
                return response()->json(['message' => 'متاسفانه اشتباه میزنید:)'], 422);
            }

            $arrays = Post::getCategory($slug)->orderBy('created_at', 'desc')->paginate(10);
        }
        $posts = array();
        foreach ($arrays as $post) {
            // make post content summer
            $string = strip_tags($post->content);
            if (strlen($string) > 500) {
                // truncate string
                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                //  $string .= '';
            }
            $temp = null;
            $temp["id"] = $post->id;
            $temp["title"] = $post->title;
            $temp["content"] = $string;
            $temp["image"] = '/uploads/photos/' . $post->image;
            $temp["created"] = verta($post->created_at)->format('%d %B، %Y');
            $temp["user"] = $post->user->family . ' ' . $post->user->name;
            $temp["category"] = $post->with(['categories' => function ($query) {
                $query->select('name', 'slug');
            }])->select('id')->get();
            $temp["comment"] = count($post->comments);
            array_push($posts, $temp);
        }

        $arrays = Post::inRandomOrder()->take(6)->get();
        $random_posts = array();
        foreach ($arrays as $post) {
            $temp = null;
            $temp["id"] = $post->id;
            $temp["title"] = $post->title;
            $temp["image"] = '/uploads/photos/' . $post->image;
            $temp["user"] = $post->user->family . ' ' . $post->user->name;
            array_push($random_posts, $temp);
        }

        $categories = BlogCategory::select(['name', 'slug'])->withCount('posts')->get();

        return response()->json(['posts' => $posts, 'categories' => $categories, 'random_posts' => $random_posts], 200);
    }
    /**
     * Return Single post
     */
    public function BlogPostSingle($id)
    {
        $item = Post::where('id', $id)->first();
        if ($item == null) {
            return response()->json(['message' => 'متاسفانه اشتباه میزنید:)'], 422);
        }

        $post = [];
        $post["title"] = $item->title;
        $post["content"] = $item->content;
        $post["image"] = '/uploads/photos/' . $item->image;
        $post["created"] = verta($item->created_at)->format('%d %B، %Y');
        $post["user"] = $item->user->family . ' ' . $item->user->name;
        $post["category"] = $item->with(['categories' => function ($query) {
            $query->select('name', 'slug');
        }])->select('id')->get();
        $post["comment"] = $item->comments;

        //Get relations post
        if ($post["category"][0]['categories'] != '[]') {
            $arrays = Post::getCategory($post["category"][0]['categories'][0]["slug"])->take(5)->get();
            $relations = array();
            foreach ($arrays as $item) {
                $temp = null;
                $temp["id"] = $item->id;
                $temp["title"] = $item->title;
                $temp["image"] = '/uploads/photos/' . $item->image;
                $temp["user"] = $item->user->family . ' ' . $item->user->name;
                array_push($relations, $temp);
            }
        } else {
            $relations = null;
        }

        //Get random posts
        $arrays = Post::inRandomOrder()->take(6)->get();
        $random_posts = array();
        foreach ($arrays as $item) {
            $temp = null;
            $temp["id"] = $item->id;
            $temp["title"] = $item->title;
            $temp["image"] = '/uploads/photos/' . $item->image;
            $temp["user"] = $item->user->family . ' ' . $item->user->name;
            array_push($random_posts, $temp);
        }

        $categories = BlogCategory::select(['name', 'slug'])->withCount('posts')->get();
        return response()->json(['post' => $post, 'categories' => $categories, 'random_posts' => $random_posts, 'relations' => $relations], 200);
    }

    /**
     * Blog Post  Search
     */
    public function BlogPostSearch(Request $request)
    {
        $arrays = Post::where('title', 'like', '%' . $request["query"] . '%')->orWhere('content', 'like', '%' . $request["query"] . '%')->get();
        $posts = array();
        foreach ($arrays as $post) {
            // make post content summer
            $string = strip_tags($post->content);
            if (strlen($string) > 500) {
                // truncate string
                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                //  $string .= '';
            }
            $temp = null;
            $temp["id"] = $post->id;
            $temp["title"] = $post->title;
            $temp["content"] = $string;
            $temp["image"] = '/uploads/photos/' . $post->image;
            $temp["created"] = verta($post->created_at)->format('%d %B، %Y');
            $temp["user"] = $post->user->family . ' ' . $post->user->name;
            $temp["category"] = $post->with(['categories' => function ($query) {
                $query->select('name', 'slug');
            }])->select('id')->get();
            $temp["comment"] = count($post->comments);
            array_push($posts, $temp);
        }
        return response()->json(['result' => $posts], 200);
    }

    /**
     * Search Products
     */
    public function Search(Request $request)
    {
        $arrays = Product::where('name', 'like', '%' . $request["query"] . '%')->orWhere('brand', 'like', '%' . $request["query"] . '%')->orWhere('en_name', 'like', '%' . $request["query"] . '%')->orWhere('code', 'like', '%' . $request["query"] . '%')->orWhere('description', 'like', '%' . $request["query"] . '%')->get();
        $products = array();
        foreach ($arrays as $product) {
            /**
             * if check product have  discount or null
             */
            if (isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <= \Carbon::today() && $product->discountproduct[0]->finished_at >= \Carbon::today()) {
                $item["price"] = $product->discountproduct[0]->price;
                $item["lprice"] = $product->price()->price;
                $item["finished_at"] = $product->discountproduct[0]->finished_at;
            } else {
                $item["price"] = $product->price()->price;
                $item["lprice"] = null;
            }
            /**
             * check product  have image or no
             */
            if ($product->images() != "[]") {
                $item["image"] = $product->images()->first()->link;
            } else {
                $item["image"] = $this->defaultImage;
            }
            $item["slug"] = $product->slug;
            $item["name"] = $product->name;
            $item["brand"] = $product->brand;
            $item['id'] = $product->id;

            if ($product->status == 1) {
                $item["status"] = "موجود می باشد";
            } else {
                $item["status"] = "موجود نمی باشد";
            }

            $string = strip_tags($product->description);
            if (strlen($string) > 500) {
                // truncate string
                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                //  $string .= '';
            }
            $item["desc"] = $string;
            array_push($products, $item);
        }
        return response()->json(['result' => $products], 200);
    }
    /**
     * Contact Us Save
     */
    public function Contact(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'phone' => 'required', 'message' => 'required', 'verify' => 'required']);
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfPxWIUAAAAANE6wZbLQz65xWjAMSjCfWEG7jiG&response=" . $request->verify . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if ($response->success != true) {
            return response()->json(['message' => 'متاسفانه شما ربات شناخته شدید :)'], 422);
        }
        $contact = Setting::first();
        $to = $contact->contact_email;
        $subject = " ارتباط با ما فروشگاه " . $contact->name;
        $name = $request->name;
        $phone = $request->phone;
        $mail = $request->email;
        $messages = $request->message;
        // mail($to,$subject,$message,$headers);
        $email = \Mail::send('emails.email', ['name' => $name, 'phone' => $phone, 'mail' => $mail, 'messages' => $messages], function ($message) use ($mail, $subject, $to, $name) {
            $message->from($mail, $name);
            $message->to($to)->subject($subject);
        });
        return response()->json("ok");
    }

    /**
     * Custom page
     */
    public function Page($slug)
    {
        $post = Page::where('link', $slug)->first();
        if ($post) {
            return response()->json(['post' => $post], 200);
        } else {
            return response()->json(['error' => 'page not found'], 404);
        }

    }
}
