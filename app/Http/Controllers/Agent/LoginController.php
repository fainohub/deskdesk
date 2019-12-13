<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.agent.login');
    }

    public function login(Request $request)
    {
        dd($request->all());
    }
}
