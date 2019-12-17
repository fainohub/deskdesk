<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Services\Contracts\TicketMessageServiceInterface;

class TicketMessageController extends Controller
{
    private $ticketMessageService;

    public function __construct(TicketMessageServiceInterface $ticketMessageService)
    {
        $this->middleware('auth:agent');

        $this->ticketMessageService = $ticketMessageService;
    }

    public function store(StoreTicketMessageRequest $request, $id)
    {
        $agent = Auth::user();

        $this->ticketMessageService->createAgentMessage($request, $id, $agent);

        session()->flash('success_message', __('Mensagem enviada com sucesso!'));

        return redirect()->back();
    }
}
