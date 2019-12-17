<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Services\Contracts\TicketMessageServiceInterface;

class TicketMessageController extends Controller
{
    private $ticketMessageService;

    public function __construct(TicketMessageServiceInterface $ticketMessageService)
    {
        $this->middleware('auth:customer');

        $this->ticketMessageService = $ticketMessageService;
    }

    public function store(StoreTicketMessageRequest $request, $id)
    {
        $customer = Auth::user();

        $this->ticketMessageService->createCustomerMessage($request, $id, $customer);

        session()->flash('success_message', __('Mensagem salva com sucesso!'));

        return redirect()->back();
    }
}
