<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Services\FindAgentServiceFactory;

class AllocateAgentToTicket
{
    private $findAgentServiceFactory;

    public function __construct(FindAgentServiceFactory $findAgentServiceFactory)
    {
        $this->findAgentServiceFactory = $findAgentServiceFactory;
    }

    public function handle(TicketCreated $event)
    {
        $ticket = $event->ticket();

        $findAgentService = $this->findAgentServiceFactory->create();

        $agent = $findAgentService->find();

        $ticket->agent()->associate($agent);
        $ticket->save();
    }
}
