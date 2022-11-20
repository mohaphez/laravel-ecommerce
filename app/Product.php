<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Waavi\Tagging\Traits\Taggable;

class Product extends Model
{
    use Taggable;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = ['id', 'name', 'en_name', 'code', 'color', 'status', 'marketer_price', 'price', 'seo_keyword', 'seo_description', 'vat', 'brand', 'available_num', 'description', 'category_id', 'subcategory_id', 'item_id', 'file', 'suggest'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function product_color()
    {
        return $this->hasMany('App\ProductColor');
    }
    public function product_comment()
    {
        return $this->hasMany('App\ProductComment');
    }
    public function product_price()
    {
        return $this->hasMany('App\ProductPrice');
    }
    public function product_image()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function product_option()
    {
        return $this->hasMany('App\ProductOption');
    }
    public function discountproduct()
    {
        return $this->hasMany('App\DiscountProduct', 'product_id');
    }
    public function product_feature()
    {
        return $this->hasMany('App\ProductFeature');
    }
    public function property()
    {
        return $this->hasMany('App\ProducProperty');
    }
    public function suggest()
    {
        return $this->hasMany('App\Suggest');
    }
    public function images()
    {
        $images = ProductImage::where('product_id', $this->id)->get();
        return $images;
    }

    public function features()
    {
        $features = ProductFeature::where('product_id', $this->id)->get();
        return $features;
    }

    public function comments()
    {
        $comments = ProductComment::where('product_id', $this->id)->where('status', 1)->get();
        return $comments;
    }

    public function price()
    {
        $price = ProductPrice::where('product_id', $this->id)->first();
        return $price;
    }

    /**
     * product function for json api
     */
    public static function productItem($query, $value)
    {
        $product = Product::where($query, $value)->first();
        if ($product == null) {return null;}
        $item = array();
        /**
         * if check product have  discount or null
         */
        if (isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <= \Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= \Carbon\Carbon::today()) {
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
            $item["image"] = '/uploads/photos/default.png';
        }
        $item["slug"] = $product->slug;
        $item["name"] = $product->name;
        $item["brand"] = $product->brand;
        $item['id'] = $product->id;
        /**
         * set product options
         */
        $results = ProductOption::where('product_id', $product->id)->select('id', 'name', 'value', 'price')->get();
        $options = $results
            ->groupBy(function ($result, $key) {
                return $result->name;
            });
        /**
         * Set default options
         */
        $defaults = array();
        foreach ($options as $key => $option) {
            array_push($defaults, $option[0]);
        }
        $item["defaults"] = $defaults;
        /**set product Status */
        if ($product->status == 1) {
            $item["status"] = "موجود می باشد";
        } else {
            $item["status"] = "موجود نمی باشد";
        }
        $item["likes"] = ProductComment::where('product_id', $product->id)->avg('like') != null ? ProductComment::where('product_id', $product->id)->avg('like') : 0;

        /**
         * generate Download Link
         */
        if ($product->price == 0 && $product->file != null) {
            $item["file"] = route('downloadPublic', ['id' => $product->id]);
        } else {
            $item["file"] = null;
        }
        $item["exist"] = $product->available_num > 0 && $product->status ? true : false;
        return $item;
    }

    /**
     * product function deatail json api
     */
    public static function productDetail($slug)
    {
        $product = Product::where("slug", $slug)->first();
        if ($product == null) {return null;}
        $item = array();
        /**
         * if check product have  discount or null
         */
        if (isset($product->discountproduct[0]->price) == true && $product->discountproduct[0]->started_at <= \Carbon\Carbon::today() && $product->discountproduct[0]->finished_at >= \Carbon\Carbon::today()) {
            $item["price"] = $product->discountproduct[0]->price;
            $item["lprice"] = $product->price()->price;
            $item["finished_at"] = $product->discountproduct[0]->finished_at;
        } else {
            $item["price"] = $product->price()->price;
            $item["lprice"] = null;
        }
        $item["slug"] = $product->slug;
        $item["name"] = $product->name;
        $item["brand"] = $product->brand;
        $item["code"] = $product->code;
        $item["description"] = $product->description;
        $item["seo_description"] = $product->seo_description;
        $item["seo_keyword"] = $product->seo_keyword;
        $item["category"] = $product->category->name;
        $item["subcategory"] = $product->subcategory->name;
        $item['id'] = $product->id;
        $string = strip_tags($product->description);
        if (strlen($string) > 500) {
            // truncate string
            $stringCut = substr($string, 0, 500);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        }
        $item["desc_summer"] = $string;
        $item["likes"] = ProductComment::where('product_id', $product->id)->avg('like') != null ? ProductComment::where('product_id', $product->id)->avg('like') : 0;
        /**
         * check product  have image or no
         */
        if ($product->images() != "[]") {
            $item["images"] = $product->images()->toArray();
        } else {
            $item["images"] = ['/uploads/photos/default.png'];
        }
        /**
         * Set Product Features
         */
        //  $item["features"] = $product->features()->toArray();
        /**
         * set product options
         */
        $results = ProductOption::where('product_id', $product->id)->select('id', 'name', 'value', 'price')->get();
        $item["options"] = $results
            ->groupBy(function ($result, $key) {
                return $result->name;
            });
        /**
         * Set Comments
         */
        $temps = $product->comments();
        $comments = array();
        foreach ($temps as $temp) {
            $comment["title"] = $temp->title;
            $comment["user"] = $temp->user->name . " " . $temp->user->family;
            $comment["date"] = verta($temp->created_at)->format('%B %d، %Y');
            $comment["comment"] = $temp->comment;
            $comment["reply_user"] = $temp->reply_user_id != null ? $temp->user_reply->name . " " . $temp->user_reply->family : null;
            $comment["reply_comment"] = $temp->reply_comment;
            $comment["reply_date"] = verta($temp->updated_at)->format('%B %d، %Y');
            $comment["like"] = $temp->like;
            array_push($comments, $comment);
        }
        $item["comments"] = $comments;

        /**
         * generate Download Link
         */
        if ($product->price == 0 && $product->file != null) {
            $item["file"] = route('downloadPublic', ['id' => $product->id]);
        } else {
            $item["file"] = null;
        }
        /**
         * product items
         */
        $items = array();
        foreach ($product->features() as $row) {
            $feature["item"] = $row->item;
            $feature["value"] = $row->value;
            array_push($items, $feature); ///
        }
        $item["items"] = $items;
        $item["exist"] = $product->available_num > 0 && $product->status ? true : false;
        return $item;
    }
}
