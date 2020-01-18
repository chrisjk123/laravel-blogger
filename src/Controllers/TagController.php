<?php

namespace Chriscreates\Blog\Controllers;

use Chriscreates\Blog\Tag;
use Illuminate\Http\Request;

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
     * @param  \Chriscreates\Blog\Requests\ValidateTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateTagRequest $request) : JsonResponse
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chriscreates\Blog\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag) : JsonResponse
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidateTagRequest  $request
     * @param  \Chriscreates\Blog\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateTagRequest $request, Tag $tag) : JsonResponse
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chriscreates\Blog\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag) : JsonResponse
    {
    }
}
