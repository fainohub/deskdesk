<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

abstract class Criteria
{
    public abstract function apply($model, RepositoryInterface $repository);
}
