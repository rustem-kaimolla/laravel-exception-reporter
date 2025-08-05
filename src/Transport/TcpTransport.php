<?php

namespace LaravelExceptionReporter\Transport;

class TcpTransport
{
    protected string $host;
    protected int $port;
    protected int $timeout;

    public function __construct(string $host, int $port, int $timeout = 3)
    {
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    public function send(array $data): void
    {
        $socket = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);

        if (!$socket) {
            throw new \RuntimeException("TCP connection failed: $errstr ($errno)");
        }

        fwrite($socket, json_encode($data, JSON_THROW_ON_ERROR));
        fclose($socket);
    }
}
