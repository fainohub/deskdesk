<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;

interface CustomerServiceInterface
{

    public function create(StoreCustomerRequest $request): Customer;

    public function countAll(): int;
}
