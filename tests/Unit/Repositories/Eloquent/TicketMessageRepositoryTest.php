<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\TicketMessage;
use App\Repositories\Contracts\TicketMessageRepositoryInterface;

class TicketMessageRepositoryTest extends TestCase
{
    /**
     * @var TicketMessageRepositoryInterface
     */
    private $ticketMessageRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketMessageRepository = $this->app->make(TicketMessageRepositoryInterface::class);
    }

    public function testAll()
    {
        factory(TicketMessage::class)->create();

        $tickets = $this->ticketMessageRepository->all();

        $this->assertNotEmpty($tickets);
    }

    public function testPaginate()
    {
        factory(TicketMessage::class)->create();

        $tickets = $this->ticketMessageRepository->paginate();

        $this->assertNotEmpty($tickets);
    }

    public function testCreate()
    {
        $ticketMessageFake = factory(TicketMessage::class)->make();

        $data = [
            'ticket_id'        => $ticketMessageFake->ticket_id,
            'message'          => $ticketMessageFake->message,
            'commentable_id'   => $ticketMessageFake->commentable_id,
            'commentable_type' => $ticketMessageFake->commentable_type
        ];

        $ticketMessage = $this->ticketMessageRepository->create($data);

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
    }

    public function testUpdate()
    {
        $ticketMessageFake = factory(TicketMessage::class)->create();

        $data = [
            'message' => 'Thiago'
        ];

        $ticketMessage = $this->ticketMessageRepository->update($data, $ticketMessageFake->id);

        $this->assertEquals(1, $ticketMessage);
    }

    public function testDelete()
    {
        $ticketMessageFake = factory(TicketMessage::class)->create();

        $ticketMessage = $this->ticketMessageRepository->delete($ticketMessageFake->id);

        $this->assertEquals(1, $ticketMessage);
    }

    public function testFind()
    {
        $ticketMessageFake = factory(TicketMessage::class)->create();

        $ticketMessage = $this->ticketMessageRepository->find($ticketMessageFake->id);

        $this->assertInstanceOf(TicketMessage::class, $ticketMessage);
        $this->assertEquals($ticketMessageFake->id, $ticketMessage->id);
        $this->assertEquals($ticketMessageFake->ticket_id, $ticketMessage->ticket_id);
        $this->assertEquals($ticketMessageFake->message, $ticketMessage->message);
    }

    public function testAllByTicket()
    {
        $ticketMessageFake = factory(TicketMessage::class)->create();

        $ticketMessages = $this->ticketMessageRepository->allByTicket($ticketMessageFake->ticket_id);

        $this->assertNotEmpty($ticketMessages);
    }
}
