<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Auth;
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

    private function guard()
    {
        return Auth::guard('customer');
    }

    public function index()
    {
        return view('customer.auth.register');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->create($request);

        $this->guard()->login($customer);

        session()->flash('success_message', __('Cadastro feito com sucesso!'));

        return redirect()->route('customer.tickets.index');
    }
}
