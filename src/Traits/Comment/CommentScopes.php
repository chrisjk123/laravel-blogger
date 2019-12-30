<?php

namespace Chriscreates\Blog\Traits\Comment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CommentScopes
{
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeLastMonth(Builder $query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->subMonth(), Carbon::now(),
        ])
        ->latest();
    }

    public function scopeLastWeek(Builder $query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->subWeek(), Carbon::now(),
        ])
        ->latest();
    }
}
