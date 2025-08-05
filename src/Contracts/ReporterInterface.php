<?php

namespace LaravelExceptionReporter\Contracts;

use Throwable;

interface ReporterInterface
{
    public function report(Throwable $exception): void;
}
