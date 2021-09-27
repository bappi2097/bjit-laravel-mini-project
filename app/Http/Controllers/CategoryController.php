<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.category.index', [
            'categories' => Category::paginate(10)
        ]);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "slug" => "required|string|unique:categories,slug|max:255",
        ]);
        $category = new Category($data);
        if ($category->save()) {
            Toastr::success("Category Added Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "slug" => "required|string|max:255|unique:categories,slug," . $category->id,
        ]);
        $category->fill($data);
        if ($category->update()) {
            Toastr::success("Category Update Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            Toastr::success("Category Deleted Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return redirect(route('category.index'));
    }

    public function categoryPosts($slug)
    {
        $category = Category::with('posts')->where('slug', $slug);
        $category_name = $category->first()->name;
        $posts = $category->exists() ? $category->first()->posts()->paginate(10) : [];
        return view('pages.category', compact('posts', 'category_name'));
    }
}
