<?php

namespace Chrisjk123\Blogger\Traits\Post;

use Illuminate\Database\Eloquent\Model;

trait PostsHaveComments
{
    public function commentAsUser(Model $user, string $comment)
    {
        return $this->comments()->create([
            'content' => $comment,
            'user_id' => $user->getKey(),
            'email' => $user->email,
        ]);
    }

    public function commentAsGuest(array $fields)
    {
        return $this->comments()->create([
            'content' => $fields->content,
            'user_id' => null,
            'email' => $comment->email,
            'author' => $comment->author,
        ]);
    }
}
