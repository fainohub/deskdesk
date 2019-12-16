<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent\Filters;

use App\Repositories\Contracts\Criteria;
use App\Repositories\Contracts\RepositoryInterface;

class ByTicket extends Criteria
{
    private $ticketId;

    public function __construct(int $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('ticket_id', '=', $this->ticketId);

        return $model;
    }
}
