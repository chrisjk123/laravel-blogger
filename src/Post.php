<?php

namespace Chrisjk123\Blogger;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    public function category()
    {
        return $this->hasOne(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeWhereCategories($query, $categories = null)
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
}
