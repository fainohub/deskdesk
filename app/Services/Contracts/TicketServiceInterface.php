<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Agent;
use App\Models\Ticket;
use App\Models\Customer;
use App\Http\Requests\StoreTicketRequest;

interface TicketServiceInterface
{
    public function find(int $id): Ticket;

    public function close(int $id);

    public function create(StoreTicketRequest $request, Customer $customer): Ticket;

    public function allocate(Ticket $ticket): Ticket;

    public function ticketsPaginatedByCustomer(Customer $customer);

    public function ticketsPaginatedByAgent(Agent $agent);
}
