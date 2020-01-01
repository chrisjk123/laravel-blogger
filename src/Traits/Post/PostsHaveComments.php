<?php

namespace Chriscreates\Blog\Traits\Post;

use Illuminate\Database\Eloquent\Model;

trait PostsHaveComments
{
    public function commentAsUser(Model $user, string $comment)
    {
        if ( ! $this->allow_comments) {
            return null;
        }

        return $this->comments()->create([
            'content' => $comment,
            'user_id' => $user->getKey(),
            'email' => $user->email,
            'is_approved' => true,
        ]);
    }

    public function commentAsGuest(array $fields)
    {
        if ( ! $this->allow_comments || ! $this->allow_guest_comments) {
            return null;
        }

        return $this->comments()->create([
            'content' => $fields->content,
            'user_id' => null,
            'email' => $comment->email,
            'author' => $comment->author,
            'is_approved' => false,
        ]);
    }
}
