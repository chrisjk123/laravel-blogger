<?php

namespace Chriscreate\Blog\Traits\Comment;

trait CommentApproval
{
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeUnapproved($query)
    {
        return $query->where('is_approved', false);
    }

    public function approve()
    {
        $this->update(['is_approved' => true]);

        return $this;
    }

    public function disapprove()
    {
        $this->update(['is_approved' => false]);

        return $this;
    }
}
