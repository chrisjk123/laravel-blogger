<?php

namespace Chriscreates\Blog\Traits;

trait IsAuthorable
{
    public function author()
    {
        return $this->belongsTo(
            config('blog.user.user_class'),
            'user_id',
            config('blog.user.user_key_name')
        );
    }

    public function user()
    {
        return $this->belongsTo(
            config('blog.user.user_class'),
            'user_id',
            config('blog.user.user_key_name')
        );
    }
}
