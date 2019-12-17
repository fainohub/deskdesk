<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\TicketCreated;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Exceptions\NotFoundException;
use App\Services\Contracts\TicketServiceInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketService implements TicketServiceInterface
{
    private $ticketRepository;
    private $findAgentServiceFactory;

    public function __construct(
        TicketRepositoryInterface $ticketRepository,
        FindAgentServiceFactory $findAgentServiceFactory
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->findAgentServiceFactory = $findAgentServiceFactory;
    }

    public function find(int $id): Ticket
    {
        $ticket = $this->ticketRepository->findWithMessages($id);

        if (!$ticket) {
            throw new NotFoundException('Not found ticket');
        }

        return $ticket;
    }

    public function close(int $id)
    {
        $data = [
            'status' => Ticket::STATUS_CLOSED
        ];

        return $this->ticketRepository->update($data, $id);
    }

    public function create(StoreTicketRequest $request, Customer $customer): Ticket
    {
        $data = [
            'customer_id' => $customer->id,
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'status'      => Ticket::STATUS_OPEN
        ];

        $ticket = $this->ticketRepository->create($data);

        if ($ticket) {
            event(new TicketCreated($ticket));
        }

        return $ticket;
    }

    public function allocate(Ticket $ticket): Ticket
    {
        $findAgentService = $this->findAgentServiceFactory->create();

        $agent = $findAgentService->find();

        $ticket->agent()->associate($agent);
        $ticket->save();

        return $ticket;
    }

    public function ticketsPaginatedByCustomer(Customer $customer)
    {
        return $this->ticketRepository->ticketsPaginatedByCustomer($customer);
    }

    public function ticketsPaginatedByAgent(Agent $agent)
    {
        return $this->ticketRepository->ticketsPaginatedByAgent($agent);
    }
}
