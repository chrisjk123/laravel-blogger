<?php

namespace Chriscreates\Blog;

use Chriscreates\Blog\Traits\IsAuthorable;
use Chriscreates\Blog\Traits\Post\PostAttributes;
use Chriscreates\Blog\Traits\Post\PostScopes;
use Chriscreates\Blog\Traits\Post\PostsHaveComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use PostScopes,
    PostAttributes,
    IsAuthorable,
    PostsHaveComments;

    const PUBLISHED = 'published';
    const DRAFT = 'draft';
    const SCHEDULED = 'scheduled';

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    protected $appends = ['tagsCount'];

    protected $dates = ['published_at'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
