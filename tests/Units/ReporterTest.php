<?php

namespace LaravelExceptionReporter\Tests\Units;

use LaravelExceptionReporter\Reporter;
use LaravelExceptionReporter\Tests\TestCase;

class ReporterTest extends TestCase
{
    public function test_report_does_not_crash()
    {
        $reporter = new Reporter([
            'enabled'  => true,
            'app_name' => 'test-app',
            'tcp'      => [
                'host'    => '127.0.0.1',
                'port'    => 9999,
                'timeout' => 1,
            ],
        ]);

        $reporter->report(new \Exception("test error"));
        $this->expectNotToPerformAssertions();
    }
}
