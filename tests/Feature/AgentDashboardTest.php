<?php

namespace Tests\Feature;

use App\Models\Agent;
use Tests\TestCase;

class AgentDashboardTest extends TestCase
{
    /**
     * @var Agent
     */
    private $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agent = factory(Agent::class)->create();
    }

    public function testAgentDashboardTest()
    {
        $response = $this
            ->actingAs($this->agent)
            ->get(route('agent.dashboard.index'));

        $response->dump();

//        $response->assertStatus(200);
    }
}
