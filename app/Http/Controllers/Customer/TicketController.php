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

            session()->flash('error_message', __('Ocorreu um erro, por favor tente novamente mais tarde :('));

            return redirect()->back();
        }
    }

    public function create()
    {
        try {
            return view('customer.tickets.create');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            session()->flash('error_message', __('Ocorreu um erro, por favor tente novamente mais tarde :('));

            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {
            $ticket = $this->ticketService->find($id);

            return view('customer.tickets.show')->with('ticket', $ticket);
        } catch (NotFoundException $exception) {
            session()->flash('error_message', __('Ops, ticket não encontrado!'));

            return redirect()->back()->withErrors(__($exception->getMessage()));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            session()->flash('error_message', __('Ocorreu um erro, por favor tente novamente mais tarde :('));

            return redirect()->back();
        }
    }

    public function store(StoreTicketRequest $request)
    {
        try {
            $customer = Auth::user();
            $this->ticketService->create($request, $customer);

            session()->flash('success_message', __('Ticket criado com sucesso!'));

            return redirect()->route('customer.tickets.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            session()->flash('error_message', __('Ocorreu um erro, por favor tente novamente mais tarde :('));

            return redirect()->back();
        }
    }
}
