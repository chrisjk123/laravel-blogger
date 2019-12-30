<?php

namespace Chrisjk123\Blogger\Traits\User;

use Chrisjk123\Blogger\Post;

trait HasPosts
{
    use HasComments;

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', $this->getKeyName());
    }
}
