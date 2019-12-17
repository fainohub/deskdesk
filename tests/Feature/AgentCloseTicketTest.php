<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Agent;

class AgentCloseTicketTest extends TestCase
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

    public function testCloseTicket()
    {
        $ticket = factory(Ticket::class)->create();

        $this->assertEquals(Ticket::STATUS_OPEN, $ticket->status);

        $response = $this
            ->actingAs($this->agent, 'agent')
            ->post(route('agent.tickets.close', ['id' => $ticket->id]));

        $response->assertRedirect(route('agent.tickets.index'));
    }
}
