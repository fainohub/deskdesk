<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface CustomerRepositoryInterface extends RepositoryInterface, CriteriaInterface
{

    public function countAll(): int;

}
