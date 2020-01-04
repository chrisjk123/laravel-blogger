<?php

namespace Chriscreates\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
