<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;

interface TicketRepositoryInterface extends RepositoryInterface, CriteriaInterface
{

    public function ticketsPaginatedByCustomer(Customer $customer);

    public function ticketsPaginatedByAgent(Agent $agent);

    public function findWithMessages(int $id): ?Ticket;

    public function countAll(): int;

    public function countOpen(): int;

    public function countClosed(): int;
}
