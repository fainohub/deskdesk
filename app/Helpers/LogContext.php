<?php

declare(strict_types=1);

namespace App\Helpers;

use Exception;

final class LogContext
{
    /**
     * @var LogContext
     */
    private static $instance;

    public static function getInstance(): LogContext
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        //prevent from creating multiple instances
    }

    private function __clone()
    {
        //prevent the instance from being cloned
    }

    private function __wakeup()
    {
        //prevent from being unserialized
    }

    public static function context(Exception $exception = null): array
    {
        return self::getInstance()->getContext($exception);
    }

    public function getContext(Exception $exception = null): array
    {
        $context = array();

        $context['user'] = [
            'id'     => auth()->user() ? auth()->user()->id : null,
            'name'   => auth()->user() ? auth()->user()->name : null,
            'email'  => auth()->user() ? auth()->user()->emaul : null,
            'origin' => request()->headers->get('origin') ?? null,
            'ip'     => request()->server('REMOTE_ADDR') ?? null,
            'agent'  => request()->server('HTTP_USER_AGENT') ?? null
        ];

        if ($exception) {
            $context['exception'] = [
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'code'    => $exception->getCode(),
                'trace'   => $exception->getTraceAsString()
            ];
        }

        return $context;
    }
}
