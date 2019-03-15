<?php

namespace LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;

class Preset extends BasePreset
{
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateStyles();
        static::updateWebpackConfiguration();
        static::updateJavaScript();
        static::updateTemplates();
        static::removeNodeModules();
        static::updateGitignore();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix-purgecss' => '^2.2.0',
            'laravel-mix-tailwind' => '^0.1.0',
            'tailwindcss' => '>=0.7.3',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'jquery',
            'popper.js',
        ]));
    }

    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__ . '/../stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($files) {
            $files->cleanDirectory(resource_path('sass'));
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));

            if (!$files->isDirectory($directory = resource_path('sass'))) {
                $files->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__ . '/../stubs/resources/sass/app.sass', resource_path('sass/app.sass'));
    }

    protected static function updateJavaScript()
    {
        copy(__DIR__ . '/../stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/../stubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateTemplates()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->copyDirectory(__DIR__ . '/../stubs/views', resource_path('views'));
        });
    }

    protected static function updateGitignore()
    {
        copy(__DIR__ . '/../stubs/gitignore-stub', base_path('.gitignore'));
    }
}
