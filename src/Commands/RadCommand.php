<?php

namespace AustenCam\Preset\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RadCommand extends Command
{
    protected $signature = 'preset:rad';

    protected $description = 'Install the radical authentication preset.';

    protected $root;

    public function __construct()
    {
        parent::__construct();

        $this->root = __DIR__.'/../../';
    }

    public function copy($from, $to)
    {
        copy($this->root.$from, base_path($to));
    }

    public function handle()
    {
        $this->updateComposerJson([
            'php' => '^7.4',
            'livewire/livewire' => '^2.0',
        ]);

        $this->updateComposerJson([
            'barryvdh/laravel-debugbar' => '^3.3',
        ], 'require-dev');

        $this->installFrontend();

        // Remove package-lock.json file, Run npm and composer update
        // Make all of that automatic on post-install via composer?
        $this->info('Your app is now a lot more radical! 🤙');
    }

    protected function updateComposerJson($dependencies, $key = 'require')
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('composer.json')), true);
        $packages[$key] = array_merge($packages[$key] ?? [], $dependencies);

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected function ensureImgDirectoryExists()
    {
        $filesystem = new Filesystem;
        if (! $filesystem->isDirectory($directory = resource_path('img'))) {
            $filesystem->makeDirectory($directory, 0755, true);
        }
    }

    protected function installFrontend()
    {
        $this->copy('.prettierrc', '.prettierrc');
        $this->copy('stubs/tailwind.config.js', 'tailwind.config.js');
        $this->copy('stubs/package.json', 'package.json');
        $this->copy('stubs/webpack.mix.js', 'webpack.mix.js');
        $this->copy('stubs/resources/js/app.js', 'resources/js/app.js');
        $this->copy('stubs/new-gitignore', '.gitignore');
        $this->copy('stubs/phpunit.xml', 'phpunit.xml');
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('js/bootstrap.js'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->delete(base_path('tests/Unit/ExampleTest.php'));
            $files->delete(base_path('tests/Feature/ExampleTest.php'));
            $files->copyDirectory($this->root.'/stubs/resources/views', resource_path('views'));
            $files->copyDirectory($this->root.'/stubs/routes', base_path('routes'));
            $files->copyDirectory($this->root.'/stubs/resources/css', resource_path('css'));
            $files->copyDirectory($this->root.'/stubs/app/View/Components/Layouts', app_path('View/Components/Layouts'));
            $files->copyDirectory($this->root.'/stubs/app/Http/Livewire', app_path('Http/Livewire'));
            $files->copyDirectory($this->root.'/stubs/tests/Feature', base_path('tests/Feature'));
        });
        $this->ensureImgDirectoryExists();

        // TODO: prompt user to run other things
        // - npm i & npm run dev
        // - migrations
        // - update env.example with app name?
    }
}
