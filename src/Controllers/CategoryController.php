<?php

namespace Chriscreates\Blog\Controllers;

use Chriscreates\Blog\Category;
use Chriscreates\Blog\Requests\ValidateCategoryRequest;
use Illuminate\Http\JsonResponse;

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
     * Store a newly created resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidateCategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ValidateCategoryRequest $request) : JsonResponse
    {
        $category = Category::create($request->only([
            'name',
            'slug',
            'parent_id',
        ]));

        return response()->json($category);
    }
}
