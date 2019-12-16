<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Agent;

interface FindAgentServiceInterface
{
    public function find(): ?Agent;
}
