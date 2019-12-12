<?php

namespace Tests\Feature;

use App\Models\Customer;
use Tests\TestCase;

class CustomerLoginTest extends TestCase
{

    public function testCustomerLoginIndex()
    {
        $response = $this->get(route('customer.login.index'));

        $response->assertSuccessful();
        $response->assertViewIs('customer.auth.login');
    }

    public function testCustomerLoginPost()
    {
        $customer = factory(Customer::class)->create();

        $data = [
            'email'    => $customer->email,
            'password' => $customer->password,
        ];

        $response = $this->post(route('customer.login.post'), $data);

        //$response->assertRedirect(route('customer.tickets.index'));
        $this->assertAuthenticatedAs($customer);
    }
}
