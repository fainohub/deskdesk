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
        $this->assertAuthenticatedAs($customer, 'customer');
    }

    public function testCustomerLoginIncorrectPassword()
    {
        $password = 'laravel';

        $customer = factory(Customer::class)->create([
            'password' => $this->passwordService->encrypt($password)
        ]);

        $data = [
            'email'    => $customer->email,
            'password' => 'invalid-password',
        ];

        $response = $this->from(route('customer.login'))->post(route('customer.login.post'), $data);

        $response->assertRedirect(route('customer.login'));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testCustomerLogout()
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
        $this->assertAuthenticatedAs($customer, 'customer');

        $this->get(route('customer.logout'), $data);
        $this->assertGuest();
    }
}
