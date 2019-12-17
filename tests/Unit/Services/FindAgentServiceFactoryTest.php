<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Services\Contracts\FindAgentFactoryInterface;

class FindAgentServiceFactoryTest extends TestCase
{
    /**
     * @var FindAgentFactoryInterface
     */
    private $findAgentServiceFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->findAgentServiceFactory = $this->app->make(FindAgentFactoryInterface::class);

        factory(Agent::class, 10)->create();
    }

    public function testFindAgentServiceFactory()
    {
        $findAgentService = $this->findAgentServiceFactory->create();

        $agent = $findAgentService->find();

        $this->assertInstanceOf(Agent::class, $agent);
    }
}
