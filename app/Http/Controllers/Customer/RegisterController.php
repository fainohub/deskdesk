<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Services\Contracts\CustomerServiceInterface;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('customer.auth.register');
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $customer = $this->customerService->create($request->all());

            Auth::login($customer);

            return redirect()->route('customer.tickets.index');
        } catch (\Exception $e) {
            //TODO: Log

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }
}
