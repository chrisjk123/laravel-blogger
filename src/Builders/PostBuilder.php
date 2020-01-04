<?php

namespace Chriscreates\Blog\Builders;

use Carbon\Carbon;
use Chriscreates\Blog\Category;
use Chriscreates\Blog\Post;
use Illuminate\Support\Collection;

class PostBuilder extends Builder
{
    /**
     * Return results where Posts have status.
     *
     * @param string $status
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function status(string $status) : PostBuilder
    {
        return $this->where('status', $status);
    }

    /**
     * Return results where Posts have been published.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function published() : PostBuilder
    {
        return $this->whereIn('status', [Post::PUBLISHED, Post::SCHEDULED])
        ->where('published_at', '<=', Carbon::now());
    }

    /**
     * Return results where Posts have been scheduled to be published.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function scheduled() : PostBuilder
    {
        return $this->where(function ($query) {
            return $query->where('status', Post::SCHEDULED)
          ->where('published_at', '>', Carbon::now());
        });
    }

    /**
     * Return results where Posts are drafted.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function draft() : PostBuilder
    {
        return $this->where(function ($query) {
            return $query->where('status', Post::DRAFT)
          ->whereNull('published_at');
        });
    }

    /**
     * Return results where Posts are not yet published.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function notPublished() : PostBuilder
    {
        return $this->where(function ($query) {
            return $query->draft();
        })->orWhere(function ($query) {
            return $query->scheduled();
        });
    }

    /**
     * Order Post results by latest published.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function orderByLatest() : PostBuilder
    {
        return $this->orderBy('published_at', 'DESC');
    }

    /**
     * Return results where Posts have been published last month.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function publishedLastMonth() : PostBuilder
    {
        return $this->whereBetween('published_at', [
            Carbon::now()->subMonth(), Carbon::now(),
        ])->orderByLatest()->limit($limit);
    }

    /**
     * Return results where Posts have been published last week.
     *
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function publishedLastWeek() : PostBuilder
    {
        return $this->whereBetween('published_at', [
            Carbon::now()->subWeek(), Carbon::now(),
        ])->orderByLatest();
    }

    /**
     * Return results where Posts are related by the passed in Post Tags.
     *
     * @param \Chriscreates\Blog\Post $post
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function relatedByPostTags(Post $post) : PostBuilder
    {
        return $this->whereHas('tags', function ($query) use ($post) {
            return $query->whereIn('name', $post->tags->pluck('name'));
        })->where('id', '!=', $post->id);
    }

    /**
     * Return results where Posts are related by the passed in Post Category.
     *
     * @param \Chriscreates\Blog\Post $post
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function relatedByPostCategory(Post $post) : PostBuilder
    {
        return $this->whereHas('category', function ($query) use ($post) {
            return $query->where('id', $post->category->id);
        })->where('id', '!=', $post->id);
    }

    /**
     * Return results where Posts contain the Category(s) passed.
     *
     * @param $categories
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function whereCategories($categories = null) : PostBuilder
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

        return $this;
    }

    /**
     * Return results where Posts contain the Category(s) passed.
     *
     * @param array $options
     * @return \Chriscreates\Blog\Builders\PostBuilder
     */
    public function whereCategory(...$options) : PostBuilder
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

        // $this->with('category');

        if (is_array($collection['value'])) {
            return $this->whereHas(
                'category',
                function ($query) use ($collection) {
                    return $query->whereIn(
                        $collection['field'],
                        $collection['value']
                    );
                }
            );
        }

        return $this->whereHas(
            'category',
            function ($query) use ($collection) {
                return $query->where(
                    $collection['field'],
                    $collection['operator'],
                    $collection['value']
                );
            }
        );
    }
}
