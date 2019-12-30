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
        // search by category name
        if (is_string($categories)) {
            return $this->whereCategory('name', $categories);
        }

        // search by category id
        if (is_int($categories)) {
            return $this->whereCategory('id', $categories);
        }

        // search by multiple categories
        if (is_array($categories)) {
            if (is_int($categories[0])) {
                $field = 'id';
            } else {
                $field = 'name';
            }

            return $this->whereCategory($field, $categories);
        }

        // search by category model
        if ($categories instanceof Category) {
            return $this->whereCategory('id', $categories->id);
        }

        // search by categories collection
        if ($categories instanceof Collection) {
            return $this->whereCategory('id', $categories->pluck('id')->toArray());
        }

        return $query;
    }

    public function scopeWhereCategory(Builder $query, ...$options)
    {
        $collection = collect([
            'field' => 'id',
            'operator' => '=',
            'value' => null,
        ]);

        // Search by field and value
        if (count($options) == 2) {
            $collection = $collection->replace(['field' => $options[0]])
            ->replace(['value' => $options[1]]);
        }

        // Search by field, operator and value
        if (count($options) == 3) {
            $collection = $collection->replace(['field' => $options[0]])
            ->replace(['operator' => $options[1]])
            ->replace(['value' => $options[2]]);
        }

        $query->with('category');

        if (is_array($collection['value'])) {
            return $query->whereHas(
                'category',
                function (Builder $query) use ($collection) {
                    return $query->whereIn(
                        $collection['field'],
                        $collection['value']
                    );
                }
            );
        }

        return $query->whereHas(
            'category',
            function (Builder $query) use ($collection) {
                return $query->where(
                    $collection['field'],
                    $collection['operator'],
                    $collection['value']
                );
            }
        );
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
