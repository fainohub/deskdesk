<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Agent;

interface AgentRepositoryInterface extends RepositoryInterface, CriteriaInterface
{

    public function last(): ?Agent;

    public function first(): ?Agent;
}
