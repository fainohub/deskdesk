<?php

declare(strict_types=1);

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\RepositoryInterface;

abstract class Criteria
{
    public abstract function apply($model, RepositoryInterface $repository);
}
