<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Services\Contracts\TicketMessageServiceInterface;

class TicketMessageServiceTest extends TestCase
{
    /**
     * @var TicketMessageServiceInterface
     */
    private $ticketMessageService;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Agent
     */
    private $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketMessageService = $this->app->make(TicketMessageServiceInterface::class);

        $this->customer = factory(Customer::class)->create();
        $this->agent = factory(Agent::class)->create();
    }

    public function testAllByTicket()
    {
        $ticketMessage = factory(TicketMessage::class)->create();

        $ticketMessages = $this->ticketMessageService->allByTicket($ticketMessage->ticket_id);

        $this->assertNotEmpty($ticketMessages);
    }

    public function testCreateCustomerMessage()
    {
        $request = new StoreTicketMessageRequest();

        $ticketMessageFake = factory(TicketMessage::class)->make([
            'commentable_id'   => $this->customer->id,
            'commentable_type' => Customer::class
        ]);

        $request->merge([
            'message' => $ticketMessageFake->message,
        ]);

        $ticketMessage = $this->ticketMessageService->createCustomerMessage($request, $ticketMessageFake->ticket_id, $this->customer);

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
        $this->assertEquals($ticketMessageFake->ticket_id, $ticketMessage->ticket_id);
        $this->assertEquals($ticketMessageFake->message, $ticketMessage->message);
        $this->assertEquals($ticketMessageFake->commentable_id, $ticketMessage->commentable_id);
        $this->assertEquals($ticketMessageFake->commentable_type, $ticketMessage->commentable_type);
    }

    public function testCreateAgentMessage()
    {
        $request = new StoreTicketMessageRequest();

        $ticketMessageFake = factory(TicketMessage::class)->make([
            'commentable_id'   => $this->agent->id,
            'commentable_type' => Agent::class
        ]);

        $request->merge([
            'message' => $ticketMessageFake->message,
        ]);

        $ticketMessage = $this->ticketMessageService->createAgentMessage($request, $ticketMessageFake->ticket_id, $this->agent);

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
        $this->assertEquals($ticketMessageFake->ticket_id, $ticketMessage->ticket_id);
        $this->assertEquals($ticketMessageFake->message, $ticketMessage->message);
        $this->assertEquals($ticketMessageFake->commentable_id, $ticketMessage->commentable_id);
        $this->assertEquals($ticketMessageFake->commentable_type, $ticketMessage->commentable_type);
    }
}
