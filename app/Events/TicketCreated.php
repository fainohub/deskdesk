<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TicketCreated
{
    use Dispatchable, SerializesModels;

    private $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function ticket()
    {
        return $this->ticket;
    }
}
