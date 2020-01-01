<?php

namespace Chriscreates\Blog\Traits\Comment;

trait CommentApproval
{
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
