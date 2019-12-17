<?php

return [

    'allocate' => [
        'method' => env('ALLOCATE_AGENT_METHOD', 'random'),

        'classes' => [
            'first'  => \App\Services\FindAgentFirst::class,
            'last'   => \App\Services\FindAgentLast::class,
            'random' => \App\Services\FindAgentRandom::class,
        ],
    ]
];
