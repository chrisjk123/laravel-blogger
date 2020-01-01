<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->index('category_id');
            $table->integer('user_id')->nullable();
            $table->index('user_id');
            $table->string('title');
            $table->string('sub_title');
            $table->string('slug')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('content')->nullable();

            $table->boolean('allow_comments')->default(
                config('blogs.posts.allow_comments')
            )->nullable();

            $table->boolean('allow_guest_comments')->default(
                config('blogs.posts.allow_guest_comments')
            )->nullable();

            $table->string('status')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
