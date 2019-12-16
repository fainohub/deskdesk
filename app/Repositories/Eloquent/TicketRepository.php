<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Agent;
use App\Models\Ticket;
use App\Models\Customer;
use App\Repositories\Eloquent\Filters\ByAgent;
use App\Repositories\Eloquent\Filters\ByCustomer;
use App\Repositories\Eloquent\Filters\LatestByDate;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketRepository extends Repository implements TicketRepositoryInterface
{

    public function model()
    {
        return Ticket::class;
    }

    public function ticketsPaginatedByCustomer(Customer $customer)
    {
        $this->pushCriteria(new ByCustomer($customer));
        $this->pushCriteria(new LatestByDate('updated_at'));

        return $this->paginate();
    }

    public function ticketsPaginatedByAgent(Agent $agent)
    {
        $this->pushCriteria(new ByAgent($agent));
        $this->pushCriteria(new LatestByDate('updated_at'));

        return $this->paginate();
    }

    public function findWithMessages(int $id): ?Ticket
    {
        return $this->model->with('messages')->find($id);
    }
}
