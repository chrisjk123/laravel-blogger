<?php

namespace Chrisjk123\Blogger\Traits;

trait IsAuthorable
{
    public function author()
    {
        return $this->belongsTo(
            config('blogs.user_class'),
            'user_id',
            config('blogs.user_key_name')
        );
    }

    public function user()
    {
        return $this->belongsTo(
            config('blogs.user_class'),
            'user_id',
            config('blogs.user_key_name')
        );
    }
}
