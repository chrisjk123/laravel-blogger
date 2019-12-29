<?php

use Chrisjk123\Blogger\Category;
use Chrisjk123\Blogger\Post;
use Chrisjk123\Blogger\Tag;
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
        factory(Tag::class, 25)->create();

        factory(Category::class, 12)->create();

        factory(Post::class, 200)->create();
    }
}
