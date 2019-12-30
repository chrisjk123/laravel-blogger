<?php

namespace Chriscreates\Blog\Traits\Post;

use Chriscreates\Blog\Post;
use Illuminate\Database\Eloquent\Builder;

trait PostTagScopes
{
    public function scopeRelatedByPostTags(Builder $query, Post $post)
    {
        return $query->whereHas('tags', function (Builder $query) use ($post) {
            return $query->whereIn('name', $post->tags->pluck('name'));
        })->where('id', '!=', $post->id);
    }
}
