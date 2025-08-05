<?php

namespace LaravelExceptionReporter\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use LaravelExceptionReporter\ExceptionReporterServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ExceptionReporterServiceProvider::class,
        ];
    }
}
