<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:agent');
    }

    public function index()
    {
        return view('agent.dashboard.index');
    }
}
