<?php

namespace Chrisjk123\Blogger;

use App\User;
use Chrisjk123\Blogger\Traits\Post\PostAttributes;
use Chrisjk123\Blogger\Traits\Post\PostScopes;
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

    public function author()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
