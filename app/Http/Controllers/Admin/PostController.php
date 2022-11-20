<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use App\Post;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Image;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return view('Admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BlogCategory::all();
        return view('Admin.post.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        $post = new Post;

        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->content = $request->text;

        // upload post image
        if (request()->hasFile('image')) {

            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->save(public_path('uploads/photos/' . $filename));

            $post->image = $filename;
        }

        $post->save();

        $post->addCategories($request->category);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $category = BlogCategory::all();

        return View('Admin.post.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->content = $request->text;

        // update image
        if (request()->hasFile('image')) {

            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($post->image !== 'default.jpg') {
                $file = public_path('uploads/photos/' . $post->image);

                if (file_exists($file)) {
                    unlink($file);
                }
            }
            Image::make($image)->save(public_path('uploads/photos/' . $filename));

            $post->image = $filename;
        }

        $post->save();

        // detach all then readd categories
        $post->categories()->detach();
        $post->addCategories($request->category);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // delete category feom pivot table then delete post
        $post->categories()->detach();
        $post->comments()->delete();
        $post->delete();
        return back();
    }

    public function category()
    {
        $category = BlogCategory::all();

        return View('Admin.post.category', compact('category'));
    }

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category = new BlogCategory;

        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->save();

        return redirect()->back();
    }

    public function destroyCategory($id)
    {
        $category = BlogCategory::findOrFail($id);

        foreach ($category->posts as $post) {
            $post->categories()->detach($id);
        }
        $category->delete();
        return back();

        return back()->withErrors(['errors' => 'دسته های پیش فرض قابل پاک شدن نیستند']);
    }

    /**
     * Send post with Telegram Bot
     */
    public function telegram(Request $request)
    {
        $this->validate($request, ['body' => 'required']);
        $api = Setting::first()->tel_bot_api;
        $bot_url = "https://api.telegram.org/bot" . $api . "/";
        //  Create instance with key
        $apiKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
        $longUrl = URL::to($request->image);
        $postData = array('longUrl' => $longUrl, 'key' => $apiKey);
        $jsonData = json_encode($postData);

        $curlObj = curl_init();

        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=' . $apiKey);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($curlObj);

        //  Change the response json string to object
        $json = json_decode($response);

        curl_close($curlObj);
        $text = $request->body . "%0A %0A %0A %0A" . $json->id;

        $sendto = $bot_url . "sendmessage?chat_id=" . Setting::first()->channel_id . "&text=" . $text;
        file_get_contents($sendto);
        return redirect()->back()->with('success', "پیام با موفقیت ارسال شد !");

    }

}
