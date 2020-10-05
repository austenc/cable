<?php

namespace AustenCam\Cable\Commands;

use AustenCam\Cable\Traits\CopiesFilesAndFolders;
use AustenCam\Cable\Traits\UpdatesJsonFiles;
use Illuminate\Console\Command;

class CableCommand extends Command
{
    use CopiesFilesAndFolders, UpdatesJsonFiles;

    protected $signature = 'cable:run';

    protected $description = 'Install the cable authentication preset.';

    public function handle()
    {
        $this->composer();
        $this->dotfiles();
        $this->frontend();
        $this->components();
        $this->tests();

        $this->info('Your app is now a lot more radical! 🤙');

        // Prompt the user to do other stuff
        $this->promptForOtherCommands();
    }

    protected function promptForOtherCommands()
    {
        if ($this->confirm('Want to run composer update, npm install, and build assets now?', 'Y')) {
            system('cd '.base_path().' && composer update --ansi');
            system('cd '.base_path().' && npm i && npm run dev');
        }
    }

    protected function composer()
    {
        $this->updateJsonFile('composer.json', [
            'php' => '^7.4',
            'livewire/livewire' => '^2.0',
        ]);

        $this->updateJsonFile('composer.json', [
            'barryvdh/laravel-debugbar' => '^3.3',
        ], 'require-dev');
    }

    protected function dotfiles()
    {
        $this->copy('.prettierrc', '.prettierrc');
        $this->copy('stubs/new-gitignore', '.gitignore');
    }

    protected function frontend()
    {
        $this->delete(resource_path('js/bootstrap.js'));
        $this->ensureFolderExists(resource_path('img'));
        $this->copy('stubs/tailwind.config.js', 'tailwind.config.js');
        $this->copy('stubs/package.json', 'package.json');
        $this->copy('stubs/webpack.mix.js', 'webpack.mix.js');
        $this->copy('stubs/resources/js/app.js', 'resources/js/app.js');
        $this->copyFolder('/stubs/resources/css', resource_path('css'));
    }

    public function tests()
    {
        $this->delete(base_path('tests/Unit/ExampleTest.php'));
        $this->delete(base_path('tests/Feature/ExampleTest.php'));
        $this->copy('stubs/phpunit.xml', 'phpunit.xml');
        $this->copyFolder('/stubs/tests/Feature', base_path('tests/Feature'));
    }

    public function components()
    {
        $this->delete(resource_path('views/welcome.blade.php'));
        $this->copyFolder('/stubs/resources/views', resource_path('views'));
        $this->copyFolder('/stubs/routes', base_path('routes'));
        $this->copyFolder('/stubs/app/View/Components/Layouts', app_path('View/Components/Layouts'));
        $this->copyFolder('/stubs/app/Http/Livewire', app_path('Http/Livewire'));
    }
}
