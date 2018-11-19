<?php

namespace Naoray\DarkTailwindPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;
use Naoray\DarkTailwindPreset\Commands\AuthMakeCommand;

class DarkTailwindPresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('dark-tailwind', function ($command) {
            Preset::install();

            $command->info('Dark Tailwind scaffolding installed successfully');
            $command->info('Please run "yarn && ./node_modules/.bin/tailwind init tailwind.js && yarn dev" to compile your fresh scaffolding.');
        });

        $this->app->extend('command.auth.make', function () {
            return new AuthMakeCommand;
        });
    }
}
