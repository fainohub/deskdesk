<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface;
use Carbon\Carbon;

class AgentCreatedToday extends Criteria
{

    public function apply($model, RepositoryInterface $repository)
    {
        $now = Carbon::now();

        $model = $model->where('created_at', '=', $now->toDateString());

        return $model;
    }
}
