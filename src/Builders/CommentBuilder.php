<?php

namespace Chriscreates\Blog\Builders;

class CommentBuilder extends Builder
{
    /**
     * Return results where Comments have been approved.
     *
     * @return \Chriscreates\Blog\Builders\CommentBuilder
     */
    public function approved() : CommentBuilder
    {
        return $this->where('is_approved', true);
    }

    /**
     * Return results where Comments are not yet approved.
     *
     * @return \Chriscreates\Blog\Builders\CommentBuilder
     */
    public function unapproved() : CommentBuilder
    {
        return $this->where('is_approved', false);
    }
}
