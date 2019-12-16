<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface TicketMessageRepositoryInterface extends RepositoryInterface, CriteriaInterface
{

    public function allByTicket(int $ticketId);

}
