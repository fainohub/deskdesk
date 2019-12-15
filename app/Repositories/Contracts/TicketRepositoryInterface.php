<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Customer;

interface TicketRepositoryInterface extends RepositoryInterface, CriteriaInterface
{

    public function ticketsPaginatedByCustomer(Customer $customer);
}
