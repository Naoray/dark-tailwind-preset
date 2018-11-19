<?php

namespace Naoray\DarkTailwindPreset;

use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::ensureImgDirectoryExists();
        static::updateSassDirectory();
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateScripts();
        static::updateTemplates();
        static::removeNodeModules();
        static::updateGitignore();
    }

    /**
     * Ensures an `img` directory exists.
     *
     * @return void
     */
    public static function ensureImgDirectoryExists()
    {
        $filesystem = new Filesystem;

        if (! $filesystem->isDirectory($directory = resource_path('img'))) {
            $filesystem->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Clean Sass directory.
     *
     * @return void
     */
    public static function updateSassDirectory()
    {
        $filesystem = new Filesystem;

        if (! $filesystem->isDirectory($directory = resource_path('sass'))) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        File::cleanDirectory(resource_path('sass'));
        copy(__DIR__.'/stubs/app.scss', resource_path('sass/app.scss'));
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return array_merge(
            [
                'tailwindcss' => '^0.7.2',
                'laravel-mix-tailwind' => '^0.1.0',
                'laravel-mix-purgecss' => '^3.0.0',
            ],
            array_except($packages, [
                'bootstrap',
                'jquery',
                'popper.js'
            ])
        );
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    public static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update the script files.
     *
     * @return void
     */
    protected static function updateScripts()
    {
        copy(__DIR__.'/stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    /**
     * Update view templates.
     *
     * @return void
     */
    protected static function updateTemplates()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->copyDirectory(__DIR__ . '/stubs/views', resource_path('views'));
        });
    }

    /**
     * Update .gitignore file.
     *
     * @return void
     */
    protected static function updateGitignore()
    {
        copy(__DIR__.'/stubs/gitignore-stub', base_path('.gitignore'));
    }
}