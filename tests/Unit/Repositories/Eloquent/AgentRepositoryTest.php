<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Repositories\Eloquent\AgentRepository;

class AgentRepositoryTest extends TestCase
{
    //use DatabaseMigrations, RefreshDatabase;

    /**
     * @var AgentRepository
     */
    private $agentRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agentRepository = $this->app->make(AgentRepository::class);
    }

    public function testAll()
    {
        factory(Agent::class)->create();

        $agents = $this->agentRepository->all();

        $this->assertNotEmpty($agents);
    }

    public function testCreate()
    {
        $agentFactory = factory(Agent::class)->make();

        $data = [
            'name'     => $agentFactory->name,
            'email'    => $agentFactory->email,
            'password' => $agentFactory->password,
        ];

        $agent = $this->agentRepository->create($data);

        $this->assertInstanceOf(Agent::class, $agent);
    }
}
