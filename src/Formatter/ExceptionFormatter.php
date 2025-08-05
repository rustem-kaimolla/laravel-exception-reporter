<?php

namespace LaravelExceptionReporter\Formatter;

use Throwable;

class ExceptionFormatter
{
    protected string $app;

    public function __construct(string $app)
    {
        $this->app = $app;
    }

    public function format(Throwable $e): array
    {
        return [
            'message'   => $e->getMessage(),
            'file'      => $e->getFile(),
            'line'      => $e->getLine(),
            'code'      => $e->getCode(),
            'trace'     => collect($e->getTrace())->map(function ($t) {
                return array_intersect_key($t, array_flip(['file', 'line', 'function', 'class']));
            })->all(),
            'app'       => $this->app,
            'env'       => config('app.env'),
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
