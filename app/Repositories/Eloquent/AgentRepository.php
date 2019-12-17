<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Agent;
use App\Repositories\Contracts\AgentRepositoryInterface;
use App\Repositories\Eloquent\Filters\LatestByDate;

class AgentRepository extends Repository implements AgentRepositoryInterface
{

    public function model()
    {
        return Agent::class;
    }

    public function first(): ?Agent
    {
        return $this->model->first();
    }


    public function last(): ?Agent
    {
        $this->pushCriteria(new LatestByDate('created_at'));
        $this->applyCriteria();

        return $this->model->first();
    }
}
