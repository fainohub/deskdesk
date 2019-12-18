<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\TicketCreated;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Contracts\LogServiceInterface;
use App\Services\Exceptions\NotFoundException;
use App\Services\Contracts\TicketServiceInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketService implements TicketServiceInterface
{
    private $logService;
    private $ticketRepository;
    private $findAgentServiceFactory;

    public function __construct(
        LogServiceInterface $logService,
        TicketRepositoryInterface $ticketRepository,
        FindAgentServiceFactory $findAgentServiceFactory
    ) {
        $this->logService = $logService;
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
            $this->logService->info('Ticket Created');

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

        $this->logService->info('Ticket Allocated');

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

    public function countAll(): int
    {
        return $this->ticketRepository->countAll();
    }

    public function countOpen(): int
    {
        return $this->ticketRepository->countOpen();
    }

    public function countClosed(): int
    {
        return $this->ticketRepository->countClosed();
    }
}
