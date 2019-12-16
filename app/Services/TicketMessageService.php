<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Services\Contracts\TicketMessageServiceInterface;
use App\Repositories\Contracts\TicketMessageRepositoryInterface;

class TicketMessageService implements TicketMessageServiceInterface
{
    private $ticketMessageRepository;

    public function __construct(TicketMessageRepositoryInterface $ticketMessageRepository) {
        $this->ticketMessageRepository = $ticketMessageRepository;
    }

    public function allByTicket(int $ticketId)
    {
        return $this->ticketMessageRepository->allByTicket($ticketId);
    }

    public function createCustomerMessage(
        StoreTicketMessageRequest $request,
        int $ticketId,
        Customer $customer
    ): TicketMessage {
        $data = [
            'ticket_id'        => $ticketId,
            'message'          => $request->get('message'),
            'commentable_id'   => $customer->id,
            'commentable_type' => Customer::class
        ];

        return $this->ticketMessageRepository->create($data);
    }

    public function createAgentMessage(
        StoreTicketMessageRequest $request,
        int $ticketId,
        Agent $agent
    ): TicketMessage {
        $data = [
            'ticket_id'        => $ticketId,
            'message'          => $request->get('message'),
            'commentable_id'   => $agent->id,
            'commentable_type' => Agent::class
        ];

        return $this->ticketMessageRepository->create($data);
    }

}
