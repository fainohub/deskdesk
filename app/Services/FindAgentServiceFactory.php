<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\FindAgentFactoryInterface;
use App\Services\Contracts\FindAgentServiceInterface;
use App\Repositories\Contracts\AgentRepositoryInterface;

class FindAgentServiceFactory implements FindAgentFactoryInterface
{
    private $agentRepository;

    public function __construct()
    {
        $this->agentRepository = resolve(AgentRepositoryInterface::class);
    }

    public function create(): FindAgentServiceInterface
    {
        $method = config('agents.allocate.method');
        $classes = config('agents.allocate.classes');

        $class = $classes[$method];

        return new FindAgentService(new $class($this->agentRepository));
    }
}
