<?php

namespace Chriscreates\Blog\Traits\Post;

use Chriscreates\Blog\Category;
use Illuminate\Support\Collection;

trait PostsHaveACategory
{
    public function hasCategory($category)
    {
        if ($category instanceof Category) {
            $category = $category->id;
        }

        if (is_null($this->category)) {
            return false;
        }

        return $category_id == $this->category->id;
    }

    public function hasAnyCategory($categories)
    {
        if ($categories instanceof Collection) {
            $categories = $categories->pluck('id')->toArray();
        }

        foreach ($categories as $category) {
            if ($this->hasCategory($category)) {
                return true;
            }
        }

        return false;
    }
}
