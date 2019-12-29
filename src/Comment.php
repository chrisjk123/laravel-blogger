<?php

namespace Chrisjk123\Blogger;

use Chrisjk123\Blogger\Traits\Comment\CommentScopes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CommentScopes;

    protected $table = 'comments';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
