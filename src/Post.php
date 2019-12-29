<?php

namespace Chrisjk123\Blogger;

use Chrisjk123\Blogger\Traits\PostAttributes;
use Chrisjk123\Blogger\Traits\PostScopes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use PostScopes, PostAttributes;

    const PUBLISHED = 'published';
    const DRAFT = 'draft';
    const SCHEDULED = 'scheduled';

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    protected $appends = ['tagsCount'];

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

    // public function path()
    // {
    //     return "/posts/{$this->slug}";
    // }
}
