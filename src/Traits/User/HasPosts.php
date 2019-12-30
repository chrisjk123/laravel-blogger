<?php

namespace Chriscreate\Blog\Traits\User;

use Chriscreate\Blog\Post;

trait HasPosts
{
    use HasComments;

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', $this->getKeyName());
    }
}
