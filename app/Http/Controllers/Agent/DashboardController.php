<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\TicketServiceInterface;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    private $ticketService;
    private $customerService;

    public function __construct(
        TicketServiceInterface $ticketService,
        CustomerServiceInterface $customerService
    ) {
        $this->middleware('auth:agent');

        $this->ticketService = $ticketService;
        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('agent.dashboard.index');
    }

    public function ticketsTotal()
    {
        $data = [
            'tickets' => $this->ticketService->countAll()
        ];

        return response()->json($data, 200);
    }

    public function ticketsOpen()
    {
        $data = [
            'tickets' => $this->ticketService->countOpen()
        ];

        return response()->json($data, 200);
    }

    public function ticketsClosed()
    {
        $data = [
            'tickets' => $this->ticketService->countClosed()
        ];

        return response()->json($data, 200);
    }

    public function customersTotal()
    {
        $data = [
            'customers' => $this->customerService->countAll()
        ];

        return response()->json($data, 200);
    }
}
