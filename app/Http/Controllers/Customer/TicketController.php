<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Customer;
use App\Services\Contracts\TicketServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->middleware('auth:customer');

        $this->ticketService = $ticketService;
    }

    public function index()
    {
        $customer = Auth::user();

        $tickets = $this->ticketService->paginateByCustomer($customer);

        return view('customer.tickets.index')
            ->with('tickets', $tickets);
    }

    public function create()
    {
        return view('customer.tickets.create');
    }

    public function store(StoreTicketRequest $request)
    {
        try {
            $customer = Auth::user();

            $this->ticketService->create($request, $customer);

            return redirect()->route('customer.tickets.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }
}
