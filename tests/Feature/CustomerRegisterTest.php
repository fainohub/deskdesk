<?php

namespace Tests\Feature;

use App\Models\Customer;
use Tests\TestCase;

class CustomerRegisterTest extends TestCase
{

    public function testCustomerRegisterIndex()
    {
        $response = $this->get(route('customer.register.index'));

        $response->assertSuccessful();
        $response->assertViewIs('customer.auth.register');
    }

    public function testCustomerRegisterPost()
    {
        $customer = factory(Customer::class)->make();

        $data = [
            'name'     => $customer->name,
            'email'    => $customer->email,
            'password' => $customer->password,
        ];

        $response = $this->post(route('customer.register.store'), $data);

        $response->assertRedirect(route('customer.tickets.index'));
    }
}
