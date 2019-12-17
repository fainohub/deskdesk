<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Exceptions\NotFoundException;
use App\Services\Contracts\TicketServiceInterface;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->middleware('auth:agent');

        $this->ticketService = $ticketService;
    }

    public function index()
    {
        $agent = Auth::user();

        $tickets = $this->ticketService->ticketsPaginatedByAgent($agent);

        return view('agent.tickets.index')->with('tickets', $tickets);
    }

    public function show($id)
    {
        try {
            $ticket = $this->ticketService->find($id);

            return view('agent.tickets.show')->with('ticket', $ticket);
        } catch (NotFoundException $exception) {
            session()->flash('error_message', __('Ops, ticket não encontrado!'));

            return redirect()->back();
        }
    }

    public function close($id)
    {
        $this->ticketService->close($id);

        session()->flash('success_message', __('Ticket fechado com sucesso!'));

        return redirect()->route('agent.tickets.index');
    }
}
