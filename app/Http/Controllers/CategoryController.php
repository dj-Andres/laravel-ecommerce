<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category')); 
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $this->debug();
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
