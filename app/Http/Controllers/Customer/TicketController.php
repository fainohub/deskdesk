<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Exceptions\NotFoundException;
use App\Services\Contracts\TicketServiceInterface;

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

        $tickets = $this->ticketService->ticketsPaginatedByCustomer($customer);

        return view('customer.tickets.index')->with('tickets', $tickets);
    }

    public function create()
    {
        return view('customer.tickets.create');
    }

    public function show($id)
    {
        try {
            $ticket = $this->ticketService->find($id);

            return view('customer.tickets.show')->with('ticket', $ticket);
        } catch (NotFoundException $exception) {
            session()->flash('error_message', __('Ops, ticket não encontrado!'));

            return redirect()->back()->withErrors(__($exception->getMessage()));
        }
    }

    public function store(StoreTicketRequest $request)
    {
        $customer = Auth::user();
        $this->ticketService->create($request, $customer);

        session()->flash('success_message', __('Ticket criado com sucesso!'));

        return redirect()->route('customer.tickets.index');
    }
}
