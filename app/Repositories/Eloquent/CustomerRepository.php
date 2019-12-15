<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Customer;

class CustomerRepository extends Repository
{

    public function model()
    {
        return Customer::class;
    }

}
