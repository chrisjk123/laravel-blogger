<?php

namespace Chriscreates\Blogger;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    public function commentable()
    {
        return $this->morphTo();
    }
}
