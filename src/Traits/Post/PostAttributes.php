<?php

namespace Chriscreates\Blog\Traits\Post;

use Carbon\Carbon;

trait PostAttributes
{
    public function getTagsCountAttribute()
    {
        return $this->tags->count();
    }

    public function isPublished()
    {
        return $this->status == self::PUBLISHED
        && $this->published_at != null;
    }

    public function isDraft()
    {
        return $this->status == self::DRAFT
        && $this->published_at == null;
    }

    public function isScheduled()
    {
        return $this->status == self::SCHEDULED
        && $this->published_at > Carbon::now();
    }

    public function isNotPublished()
    {
        return $this->isDraft() || $this->isScheduled();
    }

    public function scheduleFor($date)
    {
        if ( ! $date instanceof Carbon) {
            $date = new Carbon($date);
        }

        $this->update([
            'status' => self::SCHEDULED,
            'published_at' => $date,
        ]);

        return $this;
    }

    public function publish()
    {
        $this->update([
            'status' => self::PUBLISHED,
            'published_at' => now(),
        ]);

        return $this;
    }

    public function getTimeToReadAttribute()
    {
        $word_count = str_word_count(strip_tags($this->content));

        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? 'minute' : 'minutes';
        $str_seconds = ($seconds == 1) ? 'second' : 'seconds';

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }

        return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
    }
}
