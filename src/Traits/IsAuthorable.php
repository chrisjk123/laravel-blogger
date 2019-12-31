<?php

namespace Chriscreates\Blog\Traits;

use Illuminate\Support\Facades\Auth;

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

    public static function bootBelongsToUser()
    {
        static::saving(function ($model) {
            $model->user_id = $model->user_id ?? Auth::id();
        });
    }
}
