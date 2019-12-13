<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Ticket;

class TicketRepository extends Repository
{

    public function model()
    {
        return Ticket::class;
    }
}
