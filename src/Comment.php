<?php

namespace Chriscreates\Blog;

use Chriscreates\Blog\Builders\CommentBuilder;
use Chriscreates\Blog\Traits\IsAuthorable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use IsAuthorable;

    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function __construct(array $attributes = [])
    {
        if ( ! isset($this->table)) {
            $this->setTable(config('blog.table_prefix', 'blog').'_comments');
        }

        parent::__construct($attributes);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function approve()
    {
        $this->update(['is_approved' => true]);

        return $this;
    }

    public function disapprove()
    {
        $this->update(['is_approved' => false]);

        return $this;
    }

    public function newEloquentBuilder($query) : CommentBuilder
    {
        return new CommentBuilder($query);
    }
}
