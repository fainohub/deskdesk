<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerRepositoryTest extends TestCase
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = $this->app->make(CustomerRepositoryInterface::class);
    }

    public function testAll()
    {
        factory(Customer::class)->create();

        $agents = $this->customerRepository->all();

        $this->assertNotEmpty($agents);
    }

    public function testPaginate()
    {
        factory(Customer::class)->create();

        $agents = $this->customerRepository->paginate();

        $this->assertNotEmpty($agents);
    }

    public function testCreate()
    {
        $cutomerFactory = factory(Customer::class)->make();

        $data = [
            'name'     => $cutomerFactory->name,
            'email'    => $cutomerFactory->email,
            'password' => $cutomerFactory->password,
        ];

        $customer = $this->customerRepository->create($data);

        $this->assertInstanceOf(Customer::class, $customer);
    }

    public function testUpdate()
    {
        $cutomerFactory = factory(Customer::class)->create();

        $data = [
            'name' => 'Thiago'
        ];

        $customer = $this->customerRepository->update($data, $cutomerFactory->id);

        $this->assertEquals(1, $customer);
    }

    public function testDelete()
    {
        $cutomerFactory = factory(Customer::class)->create();

        $customer = $this->customerRepository->delete($cutomerFactory->id);

        $this->assertEquals(1, $customer);
    }

    public function testFind()
    {
        $cutomerFactory = factory(Customer::class)->create();

        $customer = $this->customerRepository->find($cutomerFactory->id);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($cutomerFactory->id, $customer->id);
        $this->assertEquals($cutomerFactory->name, $customer->name);
        $this->assertEquals($cutomerFactory->email, $customer->email);
    }

    public function testCustomersCountAll()
    {
        $number = 10;

        factory(Customer::class, $number)->create();

        $count = $this->customerRepository->countAll();

        $this->assertEquals($number, $count);
    }
}
