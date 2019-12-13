<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Helpers\LogContext;

class LogContextTest extends TestCase
{

    public function testInstance()
    {
        $firstCall = LogContext::getInstance();
        $secondCall = LogContext::getInstance();

        $this->assertInstanceOf(LogContext::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }

    public function testContext()
    {
        $context = LogContext::context(new \Exception('Test Message'));

        $this->assertArrayHasKey('user', $context);
        $this->assertArrayHasKey('exception', $context);
    }
}
