<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;

interface TicketMessageServiceInterface
{
    public function allByTicket(int $ticketId);

    public function createCustomerMessage(
        StoreTicketMessageRequest $request,
        int $ticketId,
        Customer $customer
    ): TicketMessage;

    public function createAgentMessage(
        StoreTicketMessageRequest $request,
        int $ticketId,
        Agent $agent
    ): TicketMessage;

}
