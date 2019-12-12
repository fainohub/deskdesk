<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.customer.register');
    }

    public function save(Request $request)
    {
        dd($request->all());
    }
}
