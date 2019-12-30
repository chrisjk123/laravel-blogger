<?php

namespace Chriscreate\Blog\Traits\User;

use Chriscreate\Blog\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', $this->getKeyName());
    }
}
