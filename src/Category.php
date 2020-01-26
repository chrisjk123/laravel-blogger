<?php

namespace Chriscreates\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        if ( ! isset($this->table)) {
            $this->setTable(config('blog.table_prefix', 'blog').'_categories');
        }

        parent::__construct($attributes);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
