<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Exceptions\NotFoundException;
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
        try {
            $customer = Auth::user();

            $tickets = $this->ticketService->ticketsPaginatedByCustomer($customer);

            return view('customer.tickets.index')->with('tickets', $tickets);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }

    public function create()
    {
        try {
            return view('customer.tickets.create');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }

    public function show($id)
    {
        try {
            $ticket = $this->ticketService->find($id);

            return view('customer.tickets.show')->with('ticket', $ticket);
        } catch (NotFoundException $exception) {
            return redirect()->back()->withErrors(__($exception->getMessage()));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
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
