<?php

namespace Chriscreates\Blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
