<?php

namespace Chrisjk123\Blogger\Traits;

trait PostAttributes
{
    public function getTagsCountAttribute()
    {
        return $this->tags->count();
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