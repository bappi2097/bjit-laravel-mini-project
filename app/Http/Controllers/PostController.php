<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.post.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.post.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "slug" => "required|string|unique:categories,slug|max:255",
            "summery" => "required|string",
            "category" => "array",
            "category.*" => "exists:categories,id",
            "description" => "required",
            "image" => "nullable|file"
        ]);

        $data = [
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "slug" => $request->slug,
            "summery" => $request->summery,
            "description" => $request->description
        ];

        $category_ids = $request->category;
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $data["image"] = $url;
        }

        $post = new Post($data);

        if ($post->save()) {
            $post->categories()->sync($category_ids);
            Toastr::success("Post Added Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->loadMissing('categories');
        $categories = Category::all();
        return view('pages.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "slug" => "required|string|unique:categories,slug|max:255",
            "summery" => "required|string",
            "category" => "array",
            "category.*" => "exists:categories,id",
            "description" => "required",
            "image" => "nullable|file"
        ]);

        $data = [
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "slug" => $request->slug,
            "summery" => $request->summery,
            "description" => $request->description
        ];

        $category_ids = $request->category;
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $data["image"] = $url;
        }

        $post->fill($data);

        if ($post->save()) {
            $post->categories()->sync($category_ids);
            Toastr::success("Post Update Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->categories()->detach();
        if ($post->delete()) {
            Toastr::success("Post Deleted Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return redirect(route('post.index'));
    }
}
