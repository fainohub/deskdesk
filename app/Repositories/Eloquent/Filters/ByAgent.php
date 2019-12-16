<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent\Filters;

use App\Models\Agent;
use App\Repositories\Contracts\Criteria;
use App\Repositories\Contracts\RepositoryInterface;

class ByAgent extends Criteria
{
    /**
     * @var Agent
    **/
    private $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('agent_id', '=', $this->agent->id);

        return $model;
    }
}
