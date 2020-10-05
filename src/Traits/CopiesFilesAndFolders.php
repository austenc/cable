<?php

namespace AustenCam\Cable\Traits;

use Illuminate\Filesystem\Filesystem;

trait CopiesFilesAndFolders
{
    protected $rootPath = __DIR__.'/../../';

    public function copy($from, $to)
    {
        copy($this->rootPath.$from, base_path($to));
    }

    public function copyFolder($from, $to)
    {
        (new Filesystem)->copyDirectory($this->rootPath.$from, $to);
    }

    public function delete($path)
    {
        (new Filesystem)->delete($path);
    }

    public function ensureFolderExists($path)
    {
        tap(new Filesystem, function ($files) use ($path) {
            if (! $files->isDirectory($path)) {
                $files->makeDirectory($path, 0755, true);
            }
        });
    }
}
