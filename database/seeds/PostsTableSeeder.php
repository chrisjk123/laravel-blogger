<?php

use Chriscreatess\Blog\Comment;
use Chriscreatess\Blog\Post;
use Chriscreatess\Blog\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 20)
         ->create()
         ->each(function ($post) {
             $post->tags()->sync(
                 factory(Tag::class, 4)->create()->pluck('id')->toArray()
             );

             $post->comments()->save(factory(Comment::class)->make());
             $post->comments()->save(factory(Comment::class)->make());
             $post->comments()->save(factory(Comment::class)->make());
         });
    }
}
