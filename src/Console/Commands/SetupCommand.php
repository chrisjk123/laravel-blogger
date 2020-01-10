<?php

namespace Chriscreates\Blog\Console\Commands;

use Chriscreates\Blog\Comment;
use Chriscreates\Blog\Post;
use Chriscreates\Blog\Tag;
use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class SetupCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:setup {--data : Specifies that demo data should be seeded}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic blog views and routes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // TODO:
        // Controllers
        // Routes
        // Views?

        // Optionally seed the database with demo data
        if ($this->option('data')) {
            $this->seed();
        }

        $this->info('Setup complete');
    }

    /**
     * Run the demo data seeder.
     *
     * @return void
     */
    private function seed()
    {
        // TODO: Check that blog:install has been run before this blog:setup

        // Publish factories
        $files = collect(
            array_diff(scandir(__DIR__.'/../../../database/factories/'), array('.', '..'))
        )->each(function ($file) {
            copy(__DIR__."/../../../database/factories/{$file}", database_path('factories')."/{$file}");
        });

        // Create data
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
