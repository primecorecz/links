<?php

namespace Primecorecz\Links;

use Illuminate\Database\Eloquent\Relations\Relation;
use Primecorecz\Links\Models\Position;
use Primecorecz\Links\Models\Post;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LinksServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'magazine_post' => Post::class,
            'iris_position' => Position::class,
        ]);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('links')
            ->hasConfigFile('primecore-links')
            ->hasViews();
    }
}
