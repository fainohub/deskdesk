<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Agent;
use App\Models\Ticket;

class AgentTicketShowTest extends TestCase
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

    public function testTicketShow()
    {
        $ticket = factory(Ticket::class)->create([
            'customer_id' => $this->agent->id
        ]);

        $response = $this
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.tickets.show', ['id' => $ticket->id]));

        $response->assertSuccessful();
        $response->assertViewIs('agent.tickets.show');
        $response->assertViewHas('ticket');
    }

    public function testTicketNotFound()
    {
        $response = $this
            ->from(route('agent.tickets.index'))
            ->actingAs($this->agent, 'agent')
            ->get(route('agent.tickets.show', ['id' => 500]));

        $response->assertRedirect(route('agent.tickets.index'));
    }
}
