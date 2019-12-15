<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Models\Customer;
use App\Repositories\Eloquent\Filters\ByCustomer;
use App\Repositories\Eloquent\Filters\LatestByDate;

class TicketRepository extends Repository
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
}
