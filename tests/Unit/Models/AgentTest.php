<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;

class AgentTest extends TestCase
{

    public function testCreate()
    {
        $agent = factory(Agent::class)->make();
        $agent->save();

        $this->assertInstanceOf(Agent::class, $agent);
    }

}
