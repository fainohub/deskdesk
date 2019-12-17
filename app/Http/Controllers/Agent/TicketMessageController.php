<?php

namespace App\Http\Controllers\Agent;

use App\Helpers\LogContext;
use App\Http\Requests\StoreTicketMessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        try {
            $agent = Auth::user();

            $this->ticketMessageService->createAgentMessage($request, $id, $agent);

            return redirect()->with('success_message', __('Sucesso'))->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }
}
