<?php

namespace Chriscreates\Blog\Controllers;

use Chriscreates\Blog\Requests\ValidateTagRequest;
use Chriscreates\Blog\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
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
     * @param  \Chriscreates\Blog\Requests\ValidateTagRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ValidateTagRequest $request) : JsonResponse
    {
        $tag = Tag::create($request->only([
            'name',
            'slug',
        ]));

        return response()->json($tag);
    }
}
