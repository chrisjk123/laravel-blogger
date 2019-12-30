<?php

namespace Chriscreates\Blog\Traits\User;

use Chriscreates\Blog\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', $this->getKeyName());
    }
}
