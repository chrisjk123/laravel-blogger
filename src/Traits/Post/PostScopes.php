<?php

namespace Chrisjk123\Blogger\Traits\Post;

use Carbon\Carbon;
use Chrisjk123\Blogger\Category;
use Chrisjk123\Blogger\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait PostScopes
{
    public function scopeWhereCategories(Builder $query, $categories = null)
    {
        if (is_null($categories)) {
            return $query;
        }

        if (is_string($categories)) {
            return $this->whereCategory($categories, 'name');
        }

        if (is_int($categories)) {
            return $this->whereCategory($categories, 'id');
        }

        if (is_array($categories)) {
            return $query->with('category')
            ->whereHas('category', function (Builder $query) use ($categories) {
                return $query->whereIn('id', $categories);
            });
        }

        if ($categories instanceof Category) {
            return $this->whereCategory($categories->id, 'id');
        }

        if ($categories instanceof Collection) {
            return $query->with('category')
            ->whereHas('category', function (Builder $query) use ($categories) {
                return $query->whereIn(
                    'id',
                    $categories->pluck('id')->toArray()
                );
            });
        }

        return $query;
    }

    public function scopeWhereCategory(Builder $query, $category, $type = 'name')
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

    public function scopePublished(Builder $query)
    {
        return $query->where('status', self::PUBLISHED)
        ->whereNotNull('published_at');
    }

    public function scopeNotPublished(Builder $query)
    {
        return $query->whereIn('status', [
            self::DRAFT,
            self::SCHEDULED,
        ])->whereNull('published_at');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('published_at', 'DESC');
    }

    public function scopeLastMonth(Builder $query, int $limit = 5)
    {
        return $query->whereBetween('published_at', [
            Carbon::now()->subMonth(), Carbon::now(),
        ])
        ->latest()
        ->limit($limit);
    }

    public function scopeLastWeek(Builder $query)
    {
        return $query->whereBetween('published_at', [
            Carbon::now()->subWeek(), Carbon::now(),
        ])
        ->latest();
    }
}
