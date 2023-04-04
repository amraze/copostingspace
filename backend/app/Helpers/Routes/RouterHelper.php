<?php

namespace App\Helpers\Routes;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RouterHelper
{
    public static function includeApiRouteFiles(string $folder)
    {
        $recursiveDirectoryIterator = new RecursiveDirectoryIterator($folder);
        /** @var  RecursiveDirectoryIterator | RecursiveIteratorIterator $it  */

        $it = new RecursiveIteratorIterator($recursiveDirectoryIterator);

        while ($it->valid()) {
            if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }
            $it->next();
        }
    }
}
