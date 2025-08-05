<?php

namespace LaravelExceptionReporter;

use Illuminate\Support\ServiceProvider;

class ExceptionReporterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/exception-reporter.php', 'exception-reporter');

        $this->app->singleton(Reporter::class, function($app) {
            return new Reporter(config('exception-reporter'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/exception-reporter.php' => config_path('exception-reporter.php'),
        ], 'config');
    }
}
