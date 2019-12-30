<?php

namespace Chriscreates\Blog;

use Chriscreates\Blog\Traits\Comment\CommentApproval;
use Chriscreates\Blog\Traits\Comment\CommentScopes;
use Chriscreates\Blog\Traits\IsAuthorable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CommentScopes,
    CommentApproval,
    IsAuthorable;

    protected $table = 'comments';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    public function commentable()
    {
        return $this->morphTo();
    }
}
