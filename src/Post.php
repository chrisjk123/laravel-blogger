<?php

namespace Chriscreates\Blog;

use Carbon\Carbon;
use Chriscreates\Blog\Builders\PostBuilder;
use Chriscreates\Blog\Traits\IsAuthorable;
use Chriscreates\Blog\Traits\Post\PostAttributes;
use Chriscreates\Blog\Traits\Post\PostsHaveACategory;
use Chriscreates\Blog\Traits\Post\PostsHaveComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use PostAttributes,
    IsAuthorable,
    PostsHaveComments,
    PostsHaveACategory;

    public const PUBLISHED = 'published';
    public const DRAFT = 'draft';
    public const SCHEDULED = 'scheduled';

    protected $primaryKey = 'id';

    public $guarded = ['id'];

    public $timestamps = true;

    protected $appends = [
        'tags_count',
        'statuses',
        'friendly_status',
        'view_path',
        'delete_path',
    ];

    protected $dates = ['published_at'];

    public function __construct(array $attributes = [])
    {
        if ( ! isset($this->table)) {
            $this->setTable(config('blog.table_prefix', 'blog').'_posts');
        }

        parent::__construct($attributes);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function comments()
    {
        if ( ! $this->allow_comments) {
            return null;
        }

        if ( ! $this->allow_guest_comments) {
            return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('user_id');
        }

        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approvedComments()
    {
        return $this->comments()->where('is_approved', true);
    }

    public function disapprovedComments()
    {
        return $this->comments()->where('is_approved', false);
    }

    public function guestComments()
    {
        return $this->comments()->whereNull('user_id');
    }

    public function userComments()
    {
        return $this->comments()->whereNotNull('user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function newEloquentBuilder($query) : PostBuilder
    {
        return new PostBuilder($query);
    }

    public function path()
    {
        return "/posts/{$this->slug}";
    }

    public function setPublished()
    {
        $this->status = self::PUBLISHED;
        $this->published_at = now();

        return $this;
    }

    public function setDrafted()
    {
        $this->status = self::DRAFT;
        $this->published_at = null;

        return $this;
    }

    public function setScheduled($publish_date = null)
    {
        if (is_null($publish_date)) {
            $publish_date = request('published_at');
        }

        $this->status = self::SCHEDULED;
        $this->published_at = new Carbon($publish_date);

        return $this;
    }

    public function setStatus(string $status = null)
    {
        if (is_null($status)) {
            $status = request('status');
        }

        if ($status == self::PUBLISHED) {
            $this->setPublished();
        }

        if ($status == self::DRAFT) {
            $this->setDrafted();
        }

        if ($status == self::SCHEDULED) {
            $this->setScheduled(request('published_at'));
        }

        return $this;
    }

    public function setSlug(string $title = null)
    {
        $set_slug = ! is_null($title) ? $title : $this->title;

        $this->slug = Str::slug($set_slug);

        return $this;
    }

    public function statuses()
    {
        return collect([
            self::PUBLISHED,
            self::DRAFT,
            self::SCHEDULED,
        ]);
    }

    public function getStatusesAttribute()
    {
        return $this->statuses()->toArray();
    }

    public function getFriendlyStatusAttribute()
    {
        if ($this->isDraft()) {
            return ucfirst(self::DRAFT);
        }

        if ($this->isScheduled()) {
            return ucfirst(self::SCHEDULED)." for: {$this->published_at->format('d-m-Y')}";
        }

        return ucfirst(self::PUBLISHED);
    }

    public function getViewPathAttribute()
    {
        if ( ! $this->id) {
            return '';
        }

        return route('posts.show', ['post' => $this->id]);
    }

    public function getDeletePathAttribute()
    {
        if ( ! $this->id) {
            return '';
        }

        return route('posts.destroy', ['post' => $this->id]);
    }

    public function getParsedMarkdownAttribute()
    {
        $parsedown = new \Parsedown();
        $markdown = $parsedown->text($this->content);

        return $markdown;
    }
}
