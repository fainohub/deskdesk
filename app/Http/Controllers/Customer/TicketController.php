<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CustomerServiceInterface;

class TicketController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->middleware('auth:customer');

        $this->customerService = $customerService;
    }

    public function index()
    {
        echo 'TicketController@index';
    }
}
