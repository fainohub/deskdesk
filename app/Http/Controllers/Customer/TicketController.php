<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use App\Services\Contracts\CustomerServiceInterface;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->middleware('auth:customer');

        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('customer.tickets.index');
    }

    public function create()
    {
        return view('customer.tickets.create');
    }

    public function store()
    {
        try {

            return redirect()->route('customer.tickets.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }
}
