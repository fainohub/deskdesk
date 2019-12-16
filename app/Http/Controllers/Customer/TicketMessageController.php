<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\LogContext;
use App\Http\Controllers\Controller;
use App\Services\Contracts\TicketServiceInterface;
use Illuminate\Support\Facades\Log;

class TicketMessageController extends Controller
{
    private $ticketService;

    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->middleware('auth:customer');

        $this->ticketService = $ticketService;
    }


    public function store($id)
    {
        try {
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), LogContext::context($exception));

            return redirect()->back()->withErrors(__('Ocorreu um erro, por favor tente novamente mais tarde :('));
        }
    }


}
