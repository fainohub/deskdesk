<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Agent;
use App\Repositories\Contracts\AgentRepositoryInterface;
use App\Services\Contracts\FindAgentServiceInterface;

class FindAgentFirst implements FindAgentServiceInterface
{
    /**
     * @var AgentRepositoryInterface
     */
    private $agentRepository;

    public function __construct(AgentRepositoryInterface $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    public function find(): ?Agent
    {
        return $this->agentRepository->first();
    }
}
