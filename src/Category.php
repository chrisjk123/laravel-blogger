<?php

namespace Chriscreates\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
