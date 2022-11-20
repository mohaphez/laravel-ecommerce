<?php

namespace App\Http\Controllers;

use App\Baner;
use App\Post;
use App\Product;
use App\Slideshow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Counter::count('index');
        $slideshows = Slideshow::orderBy('weight', 'ASC')->get();
        $baners = Baner::where('status', 1)->get();
        $products = Product::orderBy('created_at', 'DESC')->take(8)->get();
        $suggests = Product::where('suggest', 1)->orderBy('created_at', 'DESC')->take(12)->get();
        return view('Front.index.index', compact('slideshows', 'baners', 'products', 'suggests'));
    }

    public function post($slug)
    {
        \Counter::count('post.show', $slug);
        $post = Post::findBySlug($slug);
        return view('Front.post.post', compact('post'));
    }
}
