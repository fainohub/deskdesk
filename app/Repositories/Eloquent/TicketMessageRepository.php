<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\TicketMessage;
use App\Repositories\Eloquent\Filters\ByTicket;
use App\Repositories\Contracts\TicketMessageRepositoryInterface;

class TicketMessageRepository extends Repository implements TicketMessageRepositoryInterface
{

    public function model()
    {
        return TicketMessage::class;
    }

    public function allByTicket(int $ticketId)
    {
        $this->pushCriteria(new ByTicket($ticketId));

        return $this->all();
    }
}
