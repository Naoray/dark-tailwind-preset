<?php

namespace Naoray\DarkTailwindPreset;

use Illuminate\Filesystem\Filesystem;

trait EnsuresResourceDirectoryExists
{
    /**
     * Ensures a resource directory with $name exists.
     *
     * @param string $name
     * @return void
     */
    public static function ensureResourceDirectoryExists($name)
    {
        $filesystem = new Filesystem;

        if (!$filesystem->isDirectory($directory = resource_path($name))) {
            $filesystem->makeDirectory($directory, 0755, true);
        }
    }
}
