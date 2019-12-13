<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Agent;

class AgentRepository extends Repository
{

    public function model()
    {
        return Agent::class;
    }
}
