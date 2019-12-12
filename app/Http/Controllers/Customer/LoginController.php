<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.customer.login');
    }

    public function login(Request $request)
    {
        dd($request->all());
    }
}
