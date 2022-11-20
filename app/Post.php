<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\BlogComment', 'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany('App\BlogCategory');
    }


    public static function getCategory($slug) {
      return Post::whereHas('categories', function($q) use($slug) {
          $q->where('slug', $slug);
      });
    }

    public function hasCategory($category_id)
    {
        if ($this->categories()->where('id', $category_id)->first()) {
          return true;
        }
        return false;
    }

    public function addCategories($category)
    {
        if($category)
          foreach($category as $id) {
            $this->categories()->attach(BlogCategory::where('id', $id)->first());
          }
        else
          $this->categories()->attach(BlogCategory::where('slug', 'uncategorized')->first());
    }
}
