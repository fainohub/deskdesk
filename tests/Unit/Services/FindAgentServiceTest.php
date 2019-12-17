<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Services\FindAgentFirst;
use App\Services\FindAgentLast;
use App\Services\FindAgentRandom;
use App\Services\FindAgentService;
use App\Repositories\Contracts\AgentRepositoryInterface;

class FindAgentServiceTest extends TestCase
{
    /**
     * @var AgentRepositoryInterface
     */
    private $agentRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agentRepository = $this->app->make(AgentRepositoryInterface::class);

        factory(Agent::class, 10)->create();
    }

    public function testFindFirstAgent()
    {
        $findAgentService = new FindAgentService(new FindAgentFirst($this->agentRepository));

        $agent = $findAgentService->find();

        $this->assertInstanceOf(Agent::class, $agent);
    }

    public function testFindLastAgent()
    {
        $findAgentService = new FindAgentService(new FindAgentLast($this->agentRepository));

        $agent = $findAgentService->find();

        $this->assertInstanceOf(Agent::class, $agent);
    }

    public function testFindRandomAgent()
    {
        $findAgentService = new FindAgentService(new FindAgentRandom($this->agentRepository));

        $agent = $findAgentService->find();

        $this->assertInstanceOf(Agent::class, $agent);
    }
}
