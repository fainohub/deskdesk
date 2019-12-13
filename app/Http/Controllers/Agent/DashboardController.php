<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CustomerServiceInterface;

class DashboardController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->middleware('auth:agent');

        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('agent.dashboard.index');
    }
}
