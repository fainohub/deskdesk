<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Agent;
use App\Models\TicketMessage;

class AgentTicketMessageCreateTest extends TestCase
{
    private $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agent = factory(Agent::class)->create();
    }

    public function testCreateMessageSuccess()
    {
        $ticketMessage = factory(TicketMessage::class)->make();

        $data = [
            'message' => $ticketMessage->message,
        ];

        $response = $this
            ->actingAs($this->agent, 'agent')
            ->from(route('agent.tickets.show', ['id' => $ticketMessage->ticket_id]))
            ->post(route('agent.tickets.message.store', ['id' => $ticketMessage->ticket_id]), $data);

        $response->assertRedirect(route('agent.tickets.show', ['id' => $ticketMessage->ticket_id]));
    }
}
