<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Ticket;
use App\Repositories\Eloquent\TicketRepository;

class TicketRepositoryTest extends TestCase
{
    /**
     * @var TicketRepositoryTest
     */
    private $ticketRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketRepository = $this->app->make(TicketRepository::class);
    }

    public function testAll()
    {
        factory(Ticket::class)->create();

        $tickets = $this->ticketRepository->all();

        $this->assertNotEmpty($tickets);
    }

    public function testPaginate()
    {
        factory(Ticket::class)->create();

        $tickets = $this->ticketRepository->paginate();

        $this->assertNotEmpty($tickets);
    }

    public function testCreate()
    {
        $ticketFake = factory(Ticket::class)->make();

        $data = [
            'customer_id' => $ticketFake->customer_id,
            'title'       => $ticketFake->title,
            'description' => $ticketFake->description,
            'status'      => $ticketFake->status
        ];

        $ticket = $this->ticketRepository->create($data);

        $this->assertInstanceOf(Ticket::class, $ticket);
    }

    public function testUpdate()
    {
        $ticketFake = factory(Ticket::class)->create();

        $data = [
            'title' => 'Thiago'
        ];

        $ticket = $this->ticketRepository->update($data, $ticketFake->id);

        $this->assertEquals(1, $ticket);
    }

    public function testDelete()
    {
        $ticketFake = factory(Ticket::class)->create();

        $ticket = $this->ticketRepository->delete($ticketFake->id);

        $this->assertEquals(1, $ticket);
    }

    public function testFind()
    {
        $ticketFake = factory(Ticket::class)->create();

        $ticket = $this->ticketRepository->find($ticketFake->id);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals($ticketFake->id, $ticket->id);
        $this->assertEquals($ticketFake->customer_id, $ticket->customer_id);
        $this->assertEquals($ticketFake->title, $ticket->title);
        $this->assertEquals($ticketFake->description, $ticket->description);
        $this->assertEquals($ticketFake->status, $ticket->status);
    }
}
