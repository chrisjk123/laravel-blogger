<?php

namespace Chriscreates\Blog\Traits\User;

use Chriscreates\Blog\Post;

trait HasPosts
{
    use HasComments;

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', $this->getKeyName());
    }
}
