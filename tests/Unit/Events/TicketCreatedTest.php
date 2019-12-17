<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Ticket;
use App\Events\TicketCreated;
use Illuminate\Support\Facades\Event;

class TicketCreatedTest extends TestCase
{

    public function testTicketCreatedEvent()
    {
        Event::fake();

        $ticket = factory(Ticket::class)->create();

        event(new TicketCreated($ticket));

        Event::assertDispatched(TicketCreated::class, function ($e) use ($ticket) {
            return $e->ticket()->id === $ticket->id;
        });

        Event::assertDispatched(TicketCreated::class, 1);
    }
}
