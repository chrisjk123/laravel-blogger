<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('blog.table_prefix', 'blog').'_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->index('user_id');
            $table->text('content');
            $table->string('author')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->integer('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('blog.table_prefix', 'blog').'_comments');
    }
}
