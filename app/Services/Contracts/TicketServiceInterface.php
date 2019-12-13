<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Ticket;
use App\Models\Customer;
use App\Http\Requests\StoreTicketRequest;

interface TicketServiceInterface
{

    public function create(StoreTicketRequest $request, Customer $customer): Ticket;
}
