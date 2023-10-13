<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Totov\LaravelSoftDeleteMorphToManyPivots\Commands\LaravelSoftDeleteMorphToManyPivotsCommand;

class LaravelSoftDeleteMorphToManyPivotsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-soft-delete-morph-to-many-pivots')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-soft-delete-morph-to-many-pivots_table')
            ->hasCommand(LaravelSoftDeleteMorphToManyPivotsCommand::class);
    }
}
