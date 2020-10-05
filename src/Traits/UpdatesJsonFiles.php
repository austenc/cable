<?php

namespace AustenCam\Cable\Traits;

use Illuminate\Support\Facades\Filesystem;

trait UpdatesJsonFiles
{
    protected function updateJsonFile($filename, $dependencies, $key = 'require')
    {
        if (! file_exists(base_path($filename))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path($filename)), true);
        $packages[$key] = array_merge($packages[$key] ?? [], $dependencies);

        file_put_contents(
            base_path($filename),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}
