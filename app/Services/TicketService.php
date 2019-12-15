<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Repositories\Exceptions\NotFoundException;
use App\Services\Contracts\TicketServiceInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketService implements TicketServiceInterface
{
    private $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository) {
        $this->ticketRepository = $ticketRepository;
    }

    public function find(int $id): Ticket
    {
        $ticket = $this->ticketRepository->find($id);

        if (!$ticket) {
            throw new NotFoundException('Not found ticket');
        }

        return $ticket;
    }

    public function create(StoreTicketRequest $request, Customer $customer): Ticket
    {
        $data = [
            'customer_id' => $customer->id,
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'status'      => Ticket::STATUS_OPEN
        ];

        return $this->ticketRepository->create($data);
    }

    public function ticketsPaginatedByCustomer(Customer $customer)
    {
        return $this->ticketRepository->ticketsPaginatedByCustomer($customer);
    }
}
