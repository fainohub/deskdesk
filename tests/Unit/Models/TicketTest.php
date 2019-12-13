<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Ticket;

class TicketTest extends TestCase
{

    public function testCreate()
    {
        $ticket = factory(Ticket::class)->make();
        $ticket->save();

        $this->assertInstanceOf(Ticket::class, $ticket);
    }

}
