<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface CustomerServiceInterface
{
    public function list();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));
}
