<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Agent;
use App\Services\Contracts\FindAgentServiceInterface;

class FindAgentService implements FindAgentServiceInterface
{
    /**
     * @var FindAgentServiceInterface
     */
    private $service;

    public function __construct(FindAgentServiceInterface $service)
    {
        $this->service = $service;
    }

    public function find(): ?Agent
    {
        return $this->service->find();
    }
}
