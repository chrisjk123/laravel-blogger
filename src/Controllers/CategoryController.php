<?php

namespace Chriscreates\Blog\Controllers;

use Chriscreates\Blog\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : JsonResponse
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCategoryRequest $request) : JsonResponse
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) : JsonResponse
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidateCategoryRequest  $request
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCategoryRequest $request, Category $category) : JsonResponse
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chriscreates\Blog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) : JsonResponse
    {
    }
}
