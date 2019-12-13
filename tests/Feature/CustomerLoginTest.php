<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Services\Contracts\PasswordServiceInterface;
use Tests\TestCase;

class CustomerLoginTest extends TestCase
{
    /**
     * @var PasswordServiceInterface
     */
    private $passwordService;

    public function setUp(): void
    {
        parent::setUp();

        $this->passwordService = $this->app->make(PasswordServiceInterface::class);
    }

    public function testCustomerLoginIndex()
    {
        $response = $this->get(route('customer.login'));

        $response->assertSuccessful();
        $response->assertViewIs('customer.auth.login');
    }

    public function testCustomerLoginPost()
    {
        $password = 'laravel';

        $customer = factory(Customer::class)->create([
            'password' => $this->passwordService->encrypt($password)
        ]);

        $data = [
            'email'    => $customer->email,
            'password' => $password,
        ];

        $response = $this->post(route('customer.login.post'), $data);

        $response->assertRedirect(route('customer.tickets.index'));
        $this->assertAuthenticatedAs($customer);
    }
}
