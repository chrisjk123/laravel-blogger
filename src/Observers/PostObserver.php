<?php

namespace Chriscreates\Blog\Observers;

use Chriscreates\Blog\Post;

class PostObserver
{
    /**
     * Handle the post "saving" event.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        if (request()->filled('tags')) {
            $post->tags()->sync(request('tags'));
        }

        if (request()->filled('category_id')) {
            $post->category_id = request('category_id');
        }

        if ( ! request()->filled('user_id')) {
            $post->user_id = auth()->id();
        }

        if ( ! request()->filled('slug')) {
            $post->setSlug(request('title'));
        }

        if (request()->filled('status')) {
            $post->setStatus(request('status'));
        }
    }

    /**
     * Handle the post "deleting" event.
     *
     * @param  \Chriscreates\Blog\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        $post->tags()->detach();

        $post->comments()->delete();
    }
}
