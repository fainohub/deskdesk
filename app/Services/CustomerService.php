<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\LogServiceInterface;
use App\Services\Contracts\PasswordServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    private $logService;
    private $passwordService;
    private $ticketRepository;
    private $customerRepository;

    public function __construct(
        LogServiceInterface $logService,
        PasswordServiceInterface $passwordService,
        TicketRepositoryInterface $ticketRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->logService = $logService;
        $this->passwordService = $passwordService;
        $this->customerRepository = $customerRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function create(StoreCustomerRequest $request): Customer
    {
        $data = [
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => $this->passwordService->encrypt($request->get('password')),
        ];

        $customer = $this->customerRepository->create($data);

        if ($customer) {
            $this->logService->info('Customer Created');
        }

        return $customer;
    }

    public function countAll(): int
    {
        return $this->customerRepository->countAll();
    }

}
