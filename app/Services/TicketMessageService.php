<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Services\Contracts\LogServiceInterface;
use App\Services\Contracts\TicketMessageServiceInterface;
use App\Repositories\Contracts\TicketMessageRepositoryInterface;

class TicketMessageService implements TicketMessageServiceInterface
{
    private $logService;
    private $ticketMessageRepository;

    public function __construct(
        LogServiceInterface $logService,
        TicketMessageRepositoryInterface $ticketMessageRepository
    ) {
        $this->logService = $logService;
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

        $message = $this->ticketMessageRepository->create($data);

        if ($message) {
            $this->logService->info('Ticket Message Create');
        }

        return $message;
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

        $message = $this->ticketMessageRepository->create($data);

        if ($message) {
            $this->logService->info('Ticket Message Create');
        }

        return $message;
    }

}
