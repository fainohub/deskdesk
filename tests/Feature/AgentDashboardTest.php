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

    public function testTicketsTotalWidget()
    {
        $response = $this
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.dashboard.tickets.total'));

        $response->assertSuccessful();
        $response->assertJsonStructure(['tickets']);
    }

    public function testTicketsOpenWidget()
    {
        $response = $this
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.dashboard.tickets.open'));

        $response->assertSuccessful();
        $response->assertJsonStructure(['tickets']);
    }

    public function testTicketsClosedWidget()
    {
        $response = $this
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.dashboard.tickets.closed'));

        $response->assertSuccessful();
        $response->assertJsonStructure(['tickets']);
    }

    public function testCustomersTotalWidget()
    {
        $response = $this
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.dashboard.customers.total'));

        $response->assertSuccessful();
        $response->assertJsonStructure(['customers']);
    }
}
