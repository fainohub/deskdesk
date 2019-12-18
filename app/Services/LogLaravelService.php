<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Helpers\LogContext;
use App\Services\Contracts\LogServiceInterface;
use Illuminate\Support\Facades\Log;

class LogLaravelService implements LogServiceInterface
{
    public function error(string $message, Exception $exception = null): void
    {
        Log::error($message, LogContext::context($exception));
    }

    public function info(string $message): void
    {
        Log::info($message, LogContext::context());
    }
}
