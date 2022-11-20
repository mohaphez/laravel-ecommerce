<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
class PageController extends Controller
{
    public function index()
    {
        $page = Page::all();
        return view('Admin.page.index', compact('page'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.page.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'link'  =>  'required'
        ]);

        $page = new Page;

        $page->title = $request->title;
        $page->body = $request->body;
        $page->link = $request->link;

        $page->save();

        return redirect()->route('page.index');
    }

    public function edit($id)
    {
        $post = Page::findOrFail($id);    
        return View('Admin.page.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'link'  =>  'required'
        ]);

        $page = Page::findOrFail($id);

        $page->title = $request->title;
        $page->body = $request->body;
        $page->link = $request->link;

        $page->save();

        return redirect()->route('page.index');
    }


    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return back();
    }
}
