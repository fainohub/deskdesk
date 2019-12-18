<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Exception;

interface LogServiceInterface
{
    public function error(string $message, Exception $exception = null): void;

    public function info(string $message): void;
}
