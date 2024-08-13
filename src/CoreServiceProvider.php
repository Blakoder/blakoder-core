<?php

namespace Blakoder\Core;

use Blakoder\Core\Commands\ControllerMakeCommand;
use Blakoder\Core\Commands\ExportMakeCommand;
use Blakoder\Core\Commands\ImportMakeCommand;
use Blakoder\Core\Commands\LangMakeCommand;
use Blakoder\Core\Commands\ModelMakeCommand;
use Blakoder\Core\Commands\ModuleCommand;
use Blakoder\Core\Commands\ModulesCommand;
use Blakoder\Core\Commands\NewComponentCommand;
use Blakoder\Core\Commands\PolicyMakeCommand;
use Blakoder\Core\Commands\ReplaceLinesCommand;
use Blakoder\Core\Commands\RepositoryInterfaceMakeCommand;
use Blakoder\Core\Commands\RepositoryMakeCommand;
use Blakoder\Core\Commands\RequestMakeCommand;
use Blakoder\Core\Commands\ResourceMakeCommand;
use Blakoder\Core\Commands\ScopeMakeCommand;
use Blakoder\Core\Commands\ServiceInterfaceMakeCommand;
use Blakoder\Core\Commands\ServiceMakeCommand;
use Blakoder\Core\Commands\TruncateCommand;
use Blakoder\Core\Contracts\Blakoder as BlakoderContract;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('blakoder-core')
            ->hasConfigFile('blakoder')
            ->hasMigration('create_blakoder_logs_table')
            ->hasCommands([
                TruncateCommand::class,
                ControllerMakeCommand::class,
                ExportMakeCommand::class,
                ImportMakeCommand::class,
                PolicyMakeCommand::class,
                ModelMakeCommand::class,
                LangMakeCommand::class,
                ServiceMakeCommand::class,
                ServiceInterfaceMakeCommand::class,
                RepositoryMakeCommand::class,
                RepositoryInterfaceMakeCommand::class,
                NewComponentCommand::class,
                RequestMakeCommand::class,
                ResourceMakeCommand::class,
                ReplaceLinesCommand::class,
                ScopeMakeCommand::class,
                ModuleCommand::class,
                ModulesCommand::class,
            ]);
    }

    public function packageRegistered()
    {
        // New Singleton
        $this->app->singleton(BlakoderContract::class, Blakoder::class);

        // Make an instance
        $blakoderInstance = $this->app->make(BlakoderContract::class);
        // And make it available as the 'blakoder' service
        $this->app->instance('blakoder', $blakoderInstance);

        $modules = config('blakoder.modules') ?: [];

        foreach ($modules as $key => $value) {
            $module = is_string($key) ? $key : $value;
            $config = is_array($value) ? $value : [];
            $blakoderInstance->registerModule($module, $config);
        }
        // if ($this->app->runningInConsole()) {
        //     $this->app->extend('command.make.model', function () {
        //         return new ModelMakeCommand;
        //     });
        // }
    }
}
