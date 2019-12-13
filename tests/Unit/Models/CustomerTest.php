<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{

    public function testCreate()
    {
        $customer = factory(Customer::class)->make();
        $customer->save();

        $this->assertInstanceOf(Customer::class, $customer);
    }

}
