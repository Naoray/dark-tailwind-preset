<?php

namespace Naoray\DarkTailwindPreset\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Auth\Console\AuthMakeCommand as MakeAuth;
use Naoray\DarkTailwindPreset\EnsuresResourceDirectoryExists;

class AuthMakeCommand extends MakeAuth
{
    use EnsuresResourceDirectoryExists;

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

        $this->addHasDropdownMixin();
        $this->copyImages();

        $this->info('Run `yarn dev` to publish the images.');
    }

    /**
     * Adds Has Dropdown mixin and imports it into Vue app.
     *
     * @return void
     */
    protected function addHasDropdownMixin()
    {
        static::ensureResourceDirectoryExists('js/mixins');
        copy(__DIR__.'/stubs/HasDropdown.js', resource_path('js/mixins/HasDropdown.js'));

        file_put_contents(resource_path('js/app.js'), str_replace(
            'const app = new Vue({'.PHP_EOL,
            "import HasDropdown from './mixins/HasDropdown'".PHP_EOL.
            'const app = new Vue({'.PHP_EOL.
            '  mixins: [HasDropdown],'.PHP_EOL,
            file_get_contents(resource_path('js/app.js'))
        ));
    }

    /**
     * Copy images into reosurces 'img' folder.
     *
     * @return void
     */
    protected function copyImages()
    {
        static::ensureResourceDirectoryExists('img');
        File::copyDirectory(__DIR__.'/stubs/img', resource_path('img'));
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
