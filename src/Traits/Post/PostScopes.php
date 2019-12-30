<?php

namespace Chriscreate\Blog\Traits\Post;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait PostScopes
{
    use PostCategoryScopes,
    PostTagScopes;

    public function scopePublished(Builder $query)
    {
        return $query->where(function (Builder $query) {
            return $query->where('status', self::PUBLISHED)
            ->whereNotNull('published_at');
        })->orWhere(function (Builder $query) {
            return $query->where('status', self::SCHEDULED)
            ->where('published_at', '<=', Carbon::now());
        });
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where(function (Builder $query) {
            return $query->where('status', self::SCHEDULED)
            ->where('published_at', '>', Carbon::now());
        });
    }

    public function scopeDraft(Builder $query)
    {
        return $query->where(function (Builder $query) {
            return $query->where('status', self::DRAFT)
            ->whereNull('published_at');
        });
    }

    public function scopeNotPublished(Builder $query)
    {
        return $query->where(function (Builder $query) {
            return $query->draft();
        })->orWhere(function (Builder $query) {
            return $query->scheduled();
        });
    }

    public function scopeOrderByLatest(Builder $query)
    {
        return $query->orderBy('published_at', 'DESC');
    }

    public function scopePublishedLastMonth(Builder $query, int $limit = 5)
    {
        return $query->whereBetween('published_at', [
            Carbon::now()->subMonth(), Carbon::now(),
        ])->orderByLatest()
        ->limit($limit);
    }

    public function scopePublishedLastWeek(Builder $query)
    {
        return $query->whereBetween('published_at', [
            Carbon::now()->subWeek(), Carbon::now(),
        ])->orderByLatest();
    }
}
