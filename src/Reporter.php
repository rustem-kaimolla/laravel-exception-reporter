<?php

namespace LaravelExceptionReporter;

use Throwable;
use LaravelExceptionReporter\Contracts\ReporterInterface;
use LaravelExceptionReporter\Formatter\ExceptionFormatter;
use LaravelExceptionReporter\Transport\TcpTransport;

class Reporter implements ReporterInterface
{
    protected bool $enabled;
    protected TcpTransport $transport;
    protected ExceptionFormatter $formatter;

    public function __construct(array $config)
    {
        $this->enabled = $config['enabled'] ?? true;

        $this->transport = new TcpTransport(
            $config['tcp']['host'] ?? '127.0.0.1',
            $config['tcp']['port'] ?? 9000,
            $config['tcp']['timeout'] ?? 3
        );

        $this->formatter = new ExceptionFormatter(
            $config['app_name'] ?? 'laravel-app'
        );
    }

    public function report(Throwable $exception): void
    {
        if (!$this->enabled) {
            return;
        }

        try {
            $data = $this->formatter->format($exception);
            $this->transport->send($data);
        } catch (Throwable $e) {
        }
    }
}
