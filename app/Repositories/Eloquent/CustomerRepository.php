<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{

    public function model()
    {
        return Customer::class;
    }

    public function countAll(): int
    {
        return $this->model->count();
    }
}
