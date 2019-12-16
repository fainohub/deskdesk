<?php

namespace Tests\Unit\Repositories\Eloquent;

use App\Models\Agent;
use App\Models\Customer;
use Tests\TestCase;
use App\Models\TicketMessage;

class TicketMessageTest extends TestCase
{

    public function testCreate()
    {
        $ticketMessage = factory(TicketMessage::class)->make();
        $ticketMessage->save();

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
    }

    public function testCreateCustomerMessage()
    {
        $customer = factory(Customer::class)->create();

        $ticketMessage = factory(TicketMessage::class)->make([
            'commentable_id'   => $customer->id,
            'commentable_type' => Customer::class
        ]);

        $ticketMessage->save();

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
        $this->assertInstanceOf(Customer::class, $ticketMessage->commentable);
    }

    public function testCreateAgentMessage()
    {
        $agent = factory(Agent::class)->create();

        $ticketMessage = factory(TicketMessage::class)->make([
            'commentable_id'   => $agent->id,
            'commentable_type' => Agent::class
        ]);

        $ticketMessage->save();

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
        $this->assertInstanceOf(Agent::class, $ticketMessage->commentable);
    }
}
