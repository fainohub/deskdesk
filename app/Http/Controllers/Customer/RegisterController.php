<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Services\Contracts\CustomerServiceInterface;

class RegisterController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('auth.customer.register');
    }

    public function store(StoreCustomerRequest $request)
    {
        dd($request->all());
    }
}
