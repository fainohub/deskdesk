<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Repositories\Eloquent\AgentRepository;

class AgentRepositoryTest extends TestCase
{
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

    public function testUpdate()
    {
        $agentFactory = factory(Agent::class)->create();

        $data = [
            'name' => 'Thiago'
        ];

        $agent = $this->agentRepository->update($data, $agentFactory->id);

        $this->assertEquals(1, $agent);
    }

    public function testDelete()
    {
        $agentFactory = factory(Agent::class)->create();

        $agent = $this->agentRepository->delete($agentFactory->id);

        $this->assertEquals(1, $agent);
    }

    public function testFind()
    {
        $agentFactory = factory(Agent::class)->create();

        $agent = $this->agentRepository->find($agentFactory->id);

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertEquals($agentFactory->id, $agent->id);
        $this->assertEquals($agentFactory->name, $agent->name);
        $this->assertEquals($agentFactory->email, $agent->email);
    }
}
