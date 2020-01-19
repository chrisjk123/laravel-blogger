<?php

namespace Chriscreates\Blog\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Chriscreates\Blog\Category;
use Chriscreates\Blog\Post;
use Chriscreates\Blog\Requests\ValidatePostRequest;
use Chriscreates\Blog\Tag;
use Illuminate\Http\JsonResponse;
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

        return view('blog.admin.posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        return view('blog.admin.posts.post', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidatePostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ValidatePostRequest $request) : JsonResponse
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

        return response()->json($post);
    }

    /**
     * TODO
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
        $post->load('category', 'tags');

        return view('blog.admin.posts.post', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Chriscreates\Blog\Requests\ValidatePostRequest  $request
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ValidatePostRequest $request, Post $post) : JsonResponse
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

        $post->refresh();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post) : JsonResponse
    {
        $post->delete();

        $post = new Post;

        return response()->json($post);
    }
}
