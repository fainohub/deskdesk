<?php

namespace App\Http\Controllers\Agent;

use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
            $agent = Auth::user();

            $tickets = $this->ticketService->ticketsPaginatedByAgent($agent);

            return view('agent.tickets.index')->with('tickets', $tickets);
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

            return view('agent.tickets.show')->with('ticket', $ticket);
        } catch (NotFoundException $exception) {
            session()->flash('error_message', __('Ops, ticket não encontrado!'));

            return redirect()->back()->withErrors(__($exception->getMessage()));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            session()->flash('error_message', __('Ocorreu um erro, por favor tente novamente mais tarde :('));

            return redirect()->back();
        }
    }
}
