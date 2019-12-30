<?php

namespace Chrisjk123\Blogger;

use Chrisjk123\Blogger\Traits\Comment\CommentApproval;
use Chrisjk123\Blogger\Traits\Comment\CommentScopes;
use Chrisjk123\Blogger\Traits\IsAuthorable;
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
