<?php

namespace Chrisjk123\Blogger\Traits;

use Chrisjk123\Blogger\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait PostScopes
{
    public function scopeWhereCategories(Builder $query, $categories = null)
    {
        $query->with('category');

        if (is_null($categories)) {
            return $query;
        }

        if ($categories instanceof Collection) {
            return $query->whereIn(
                'category_id',
                $categories->pluck('id')->toArray()
            );
        }

        return $query->where('category_id', $categories->id);
    }

    public function scopeWhereCategory(Builder $query, $category, $type = 'slug')
    {
        $query->with('category');

        return $query->whereHas('category', function (Builder $query) use ($type, $category) {
            return $query->where($type, $category);
        });
    }

    public function scopeRelatedByPostTags(Builder $query, Post $post)
    {
        return $query->whereHas('tags', function (Builder $query) use ($post) {
            return $query->whereIn('name', $post->tags->pluck('name'));
        })->where('id', '!=', $post->id);
    }

    public function scopeRelatedByPostCategory(Builder $query, Post $post)
    {
        return $query->whereHas('category', function (Builder $query) use ($post) {
            return $query->where('id', $post->category->id);
        })->where('id', '!=', $post->id);
    }

    public function scopeIsPublished(Builder $query)
    {
        return $query->where('status', self::PUBLISHED)
        ->whereNotNull('published_at');
    }

    public function scopeIsNotPublished(Builder $query)
    {
        return $query->whereIn('status', [
            self::DRAFT,
            self::SCHEDULED,
        ])->whereNull('published_at');
    }
}
