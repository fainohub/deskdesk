<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Repositories\Criteria\LatestByDate;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\Criteria\ByCustomer;
use App\Services\Contracts\TicketServiceInterface;

class TicketService implements TicketServiceInterface
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository) {
        $this->ticketRepository = $ticketRepository;
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

    public function paginateByCustomer(Customer $customer)
    {
        $this->ticketRepository->pushCriteria(new ByCustomer($customer));
        $this->ticketRepository->pushCriteria(new LatestByDate('updated_at'));

        return $this->ticketRepository->paginate();
    }
}
