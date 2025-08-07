# Laravel Exception Reporter

![Laravel Exception Reporter](https://raw.githubusercontent.com/rustem-kaimolla/laravel-exception-reporter/main/cmd.png)

LLM exception analysis and automatic creation of incident as bug in Jira

[![Total Downloads](https://img.shields.io/packagist/dt/rustem-kaimolla/laravel-exception-reporter.svg?style=flat-square)](https://packagist.org/packages/rustem-kaimolla/laravel-exception-reporter)

A simple exception reporting agent for Laravel applications that sends exceptions to a remote Exception Reporter Agent service https://github.com/rustem-kaimolla/exception-reporter-agent.

## Installation

Install via Composer:

```bash
composer require rustem-kaimolla/laravel-exception-reporter
```

Publish the config file:

```bash
php artisan vendor:publish --tag=exception-reporter-config
```

## Configuration

After publishing, configure the following values in your `.env` file:

```env
EXCEPTION_REPORTER_ENABLED=true
EXCEPTION_TCP_HOST=127.0.0.1
EXCEPTION_TCP_PORT=9000
```

Or configure directly in `config/exception-reporter.php`:

```php
return [
    'enabled' => env('EXCEPTION_REPORTER_ENABLED', true),
    'endpoint' => env('EXCEPTION_REPORTER_ENDPOINT'),
    'token' => env('EXCEPTION_REPORTER_TOKEN'),
];
```

## Usage

To report exceptions to the agent, you must manually call the reporter in your `App\Exceptions\Handler`:

```php
use Throwable;
use ExceptionReporter;

public function report(Throwable $exception)
{
    ExceptionReporter::report($exception); // Send exception to the agent
    parent::report($exception); // Continue Laravel's default reporting
}
```

## Advanced Integration (Optional)

If you want automatic reporting without modifying your exception handler, you can:

1. Create a custom `ExceptionHandler` and bind it in the service container:

```php
app()->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Exceptions\CustomHandler::class
);
```

2. Subscribe to Laravel's internal exception events:

```php
use Illuminate\Foundation\Exceptions\Events\ExceptionOccurred;
use Illuminate\Support\Facades\Event;
use ExceptionReporter;

Event::listen(ExceptionOccurred::class, function ($event) {
    ExceptionReporter::report($event->exception);
});
```

> Note: For production use, it's recommended to use the manual `report()` override for more control.

## License

MIT License. See [LICENSE](LICENSE) for more details.

## Contributions

Pull requests are welcome. Please open issues for feature suggestions or bugs.

---

Made with ❤️ for Laravel developers who hate debugging twice.
