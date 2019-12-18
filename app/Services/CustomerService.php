<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\PasswordServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    private $passwordService;
    private $ticketRepository;
    private $customerRepository;

    public function __construct(
        PasswordServiceInterface $passwordService,
        TicketRepositoryInterface $ticketRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->passwordService = $passwordService;
        $this->ticketRepository = $ticketRepository;
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

    public function countAll(): int
    {
        return $this->customerRepository->countAll();
    }


}
