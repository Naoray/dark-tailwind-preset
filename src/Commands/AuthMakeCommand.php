<?php

namespace Naoray\DarkTailwindPreset\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Auth\Console\AuthMakeCommand as MakeAuth;

class AuthMakeCommand extends MakeAuth
{
    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'auth/login.stub' => 'auth/login.blade.php',
        'auth/register.stub' => 'auth/register.blade.php',
        'auth/verify.stub' => 'auth/verify.blade.php',
        'auth/passwords/email.stub' => 'auth/passwords/email.blade.php',
        'auth/passwords/reset.stub' => 'auth/passwords/reset.blade.php',
        'layouts/user.stub' => 'layouts/user.blade.php',
        'home.stub' => 'home.blade.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        $filesystem = new Filesystem;

        if (! $filesystem->isDirectory($directory = resource_path('img'))) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        File::copyDirectory(__DIR__.'/stubs/img', resource_path('img'));

        $this->info('Run `yarn dev` to publish the images.');
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = resource_path('views/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/stubs/views/'.$key,
                $view
            );
        }
    }
}
