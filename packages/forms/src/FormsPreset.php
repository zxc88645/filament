<?php

namespace Filament\Forms;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;

class FormsPreset extends Preset
{
    const NPM_PACKAGES_TO_ADD = [
        '@tailwindcss/forms' => '^0.3',
        '@tailwindcss/typography' => '^0.4',
        'alpinejs' => '^3.3',
        'tailwindcss' => '^2.2',
    ];

    const NPM_PACKAGES_TO_REMOVE = [
        'axios',
        'lodash',
    ];

    public static function install()
    {
        static::updatePackages();

        $filesystem = new Filesystem();
        $filesystem->delete(resource_path('js/bootstrap.js'));
        $filesystem->copyDirectory(__DIR__ . '/../stubs', base_path());
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge(
            static::NPM_PACKAGES_TO_ADD,
            Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
        );
    }
}
