<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{

    public function testHomeIndex()
    {
        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
    }
}
