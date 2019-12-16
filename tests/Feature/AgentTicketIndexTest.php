<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Agent;

class AgentTicketIndexTest extends TestCase
{
    /**
     * @var Agent
     */
    private $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agent= factory(Agent::class)->create();
    }

    public function testTicketIndex()
    {
        $response = $this
            ->actingAs($this->agent)
            ->get(route('agent.tickets.index'));

        $response->assertSuccessful();
        $response->assertViewIs('agent.tickets.index');
        $response->assertViewHas('tickets');
    }
}
