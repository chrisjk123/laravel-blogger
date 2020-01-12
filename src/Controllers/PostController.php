<?php

namespace Chriscreates\Blog\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Chriscreates\Blog\Post;
use Chriscreates\Blog\Requests\ValidatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
      * Instantiate a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withoutGlobalScope('tags')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ValidatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePostRequest $request)
    {
        $post = Post::create($request->only([
            'title',
            'sub_title',
            'slug',
            'user_id',
            'excerpt',
            'content',
            'allow_comments',
            'allow_guest_comments',
        ]));

        return redirect()
        ->route('posts.edit', ['post' => $post->id])
        ->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $related_posts = Post::relatedByPostTags($post)
        ->take(3)
        ->get();

        SEOMeta::setTitle($post->title)
        ->setDescription($post->excerpt);

        OpenGraph::setTitle($post->title)
        ->setDescription($post->excerpt);

        return view('posts.show', compact(['post', 'related_posts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ValidatePostRequest  $request
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePostRequest $request, Post $post)
    {
        $post->update($request->only([
            'title',
            'sub_title',
            'slug',
            'user_id',
            'excerpt',
            'content',
            'allow_comments',
            'allow_guest_comments',
        ]));

        return redirect()
        ->route('posts.edit', ['post' => $post->id])
        ->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
        ->route('posts.index')
        ->with('success', 'Post deleted.');
    }
}
