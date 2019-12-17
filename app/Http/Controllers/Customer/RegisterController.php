<?php

namespace App\Http\Controllers\Customer;

use Exception;
use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Services\Contracts\CustomerServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        try {
            $customer = $this->customerService->create($request);

            $this->guard()->login($customer);

            $request->session()->flash('success_message', __('Cadastro feito com sucesso!'));

            return redirect()->route('customer.tickets.index');
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }
}
