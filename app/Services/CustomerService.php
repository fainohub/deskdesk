<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Repositories\Eloquent\CustomerRepository;
use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\PasswordServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    private $customerRepository;
    private $passwordService;

    public function __construct(
        CustomerRepository $customerRepository,
        PasswordServiceInterface $passwordService
    ) {
        $this->customerRepository = $customerRepository;
        $this->passwordService = $passwordService;
    }

    public function create(StoreCustomerRequest $request): Customer
    {
        $data = [
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => $this->passwordService->encrypt($request->get('password')),
        ];

        return $this->customerRepository->create($data);
    }
}
