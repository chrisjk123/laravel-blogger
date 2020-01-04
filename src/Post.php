<?php

namespace Chriscreates\Blog;

use Chriscreates\Blog\Builders\PostBuilder;
use Chriscreates\Blog\Traits\IsAuthorable;
use Chriscreates\Blog\Traits\Post\PostAttributes;
use Chriscreates\Blog\Traits\Post\PostsHaveACategory;
use Chriscreates\Blog\Traits\Post\PostsHaveComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use PostAttributes,
    IsAuthorable,
    PostsHaveComments,
    PostsHaveACategory;

    const PUBLISHED = 'published';
    const DRAFT = 'draft';
    const SCHEDULED = 'scheduled';

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    protected $appends = ['tagsCount'];

    protected $dates = ['published_at'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function comments()
    {
        if ( ! $this->allow_comments) {
            return null;
        }

        if ( ! $this->allow_guest_comments) {
            return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('user_id');
        }

        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approvedComments()
    {
        return $this->comments()->where('is_approved', true);
    }

    public function disapprovedComments()
    {
        return $this->comments()->where('is_approved', false);
    }

    public function guestComments()
    {
        return $this->comments()->whereNull('user_id');
    }

    public function userComments()
    {
        return $this->comments()->whereNotNull('user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function newEloquentBuilder($query) : PostBuilder
    {
        return new PostBuilder($query);
    }

    public function path()
    {
        return "/posts/{$this->slug}";
    }
}
