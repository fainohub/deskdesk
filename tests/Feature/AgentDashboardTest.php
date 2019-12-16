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
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.dashboard.index'));


        $response->assertSuccessful();
        $response->assertViewIs('agent.dashboard.index');
    }
}
