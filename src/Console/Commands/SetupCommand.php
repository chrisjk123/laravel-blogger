<?php

namespace Chriscreates\Blog\Console\Commands;

use Chriscreates\Blog\Comment;
use Chriscreates\Blog\Post;
use Chriscreates\Blog\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:setup
                            {--data : Setup the database with demo data}';

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
        if ( ! file_exists(config_path('blog.php'))) {
            $this->error("You haven't published the config file.");

            if ($this->confirm('Publish the config file?')) {
                $this->call('blog:install');
            } else {
                return;
            }
        }

        if ( ! file_exists(base_path('routes/blog.php'))) {
            $this->publishRoutes();
        }

        if ( ! file_exists(app_path('Providers/BlogServiceProvider.php'))) {
            $this->publishProvider();
        }

        // TODO: Checks
        $this->callSilent('vendor:publish', ['--tag' => 'blog-assets']);
        $this->callSilent('vendor:publish', ['--tag' => 'blog-views']);

        if ($this->option('data')) {
            $this->seed();
        } elseif ($this->confirm(
            'Would you like to setup the database with demo data?'
        )) {
            $this->seed();
        }

        $this->info('Setup complete.');
    }

    /**
     * Run the demo data seeder.
     *
     * @return void
     */
    private function seed()
    {
        $this->callSilent('vendor:publish', ['--tag' => 'blog-factories']);

        // $files = collect(
        //     array_diff(scandir(__DIR__.'/../../../database/factories/'), array('.', '..'))
        // )->each(function ($file) {
        //     copy(__DIR__."/../../../database/factories/{$file}", database_path('factories')."/{$file}");
        // });

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

    /**
     * Register the provider.
     *
     * @return void
     */
    private function publishProvider()
    {
        copy(
            __DIR__.'/../../Providers/BlogServiceProvider.php',
            app_path('Providers/BlogServiceProvider.php')
        );

        $namespace = Str::replaceLast('\\', '', $this->getAppNamespace());
        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\BlogServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol,
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol."        {$namespace}\Providers\BlogServiceProvider::class,".$eol,
            $appConfig
        ));
    }

    /**
     * Register the routes.
     *
     * @return void
     */
    private function publishRoutes()
    {
        copy(
            __DIR__.'/../../../routes/web.php',
            base_path('routes/blog.php')
        );
    }
}
