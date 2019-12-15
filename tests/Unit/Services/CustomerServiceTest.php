<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Services\Contracts\CustomerServiceInterface;

class CustomerServiceTest extends TestCase
{
    /**
     * @var CustomerServiceInterface
     */
    private $customerService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerService = $this->app->make(CustomerServiceInterface::class);
    }

    public function testCreate()
    {
        $request = new StoreCustomerRequest();

        $customerFake = factory(Customer::class)->make();

        $request->merge([
            'name'     => $customerFake->name,
            'email'    => $customerFake->email,
            'password' => $customerFake->password
        ]);

        $customer = $this->customerService->create($request);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($customerFake->name, $customer->name);
        $this->assertEquals($customerFake->email, $customer->email);
    }
}
