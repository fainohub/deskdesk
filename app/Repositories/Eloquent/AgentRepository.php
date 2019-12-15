<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Agent;
use App\Repositories\Contracts\AgentRepositoryInterface;

class AgentRepository extends Repository implements AgentRepositoryInterface
{

    public function model()
    {
        return Agent::class;
    }
}
