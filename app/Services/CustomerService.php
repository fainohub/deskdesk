<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Eloquent\CustomerRepository;
use App\Services\Contracts\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function list()
    {
        return $this->customerRepository->paginate();
    }

    public function create(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function find($id, $columns = array('*'))
    {
        // TODO: Implement find() method.
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
