<?php

namespace Chrisjk123\Blogger\Traits\User;

use Chrisjk123\Blogger\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', $this->getKeyName());
    }
}
