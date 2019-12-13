<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Http\Requests\StoreCustomerRequest;

interface CustomerServiceInterface
{
    public function list();

    public function create(StoreCustomerRequest $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));
}
