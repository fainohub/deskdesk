<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent\Filters;

use App\Models\Customer;
use App\Repositories\Contracts\Criteria;
use App\Repositories\Contracts\RepositoryInterface;

class ByCustomer extends Criteria
{

    /**
     * @var Customer
    **/
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('customer_id', '=', $this->customer->id);

        return $model;
    }
}
