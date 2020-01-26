<?php

namespace Chriscreates\Blog\Controllers;

use Chriscreates\Blog\Category;
use Chriscreates\Blog\Requests\ValidateCategoryRequest;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCategoryRequest $request)
    {
        $category = Category::create($request->only([
            'name',
            'slug',
            'parent_id',
        ]));

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Chriscreates\Blog\Requests\ValidateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCategoryRequest $request, Category $category)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
    }
}
