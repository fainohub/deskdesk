<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent\Filters;

use App\Models\Ticket;
use App\Repositories\Contracts\Criteria;
use App\Repositories\Contracts\RepositoryInterface;

class TicketClosed extends Criteria
{

    public function __construct()
    {
        //
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status', '=', Ticket::STATUS_CLOSED);

        return $model;
    }
}
