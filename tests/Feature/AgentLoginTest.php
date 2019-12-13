<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Agent;
use App\Services\Contracts\PasswordServiceInterface;

class AgentLoginTest extends TestCase
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

    public function testAgentLoginIndex()
    {
        $response = $this->get(route('agent.login'));

        $response->assertViewIs('agent.auth.login');
    }

    public function testAgentLoginPost()
    {
        $password = 'laravel';

        $agent = factory(Agent::class)->create([
            'password' => $this->passwordService->encrypt($password)
        ]);

        $data = [
            'email'    => $agent->email,
            'password' => $password,
        ];

        $response = $this->post(route('agent.login.post'), $data);

        $response->assertRedirect(route('agent.dashboard.index'));
        $this->assertAuthenticatedAs($agent, 'agent');
    }

    public function testAgentLoginIncorrectPassword()
    {
        $password = 'laravel';

        $agent = factory(Agent::class)->create([
            'password' => $this->passwordService->encrypt($password)
        ]);

        $data = [
            'email'    => $agent->email,
            'password' => 'invalid-password',
        ];

        $response = $this->from(route('agent.login'))->post(route('agent.login.post'), $data);

        $response->assertRedirect(route('agent.login'));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testAgentLogout()
    {
        $password = 'laravel';

        $agent = factory(Agent::class)->create([
            'password' => $this->passwordService->encrypt($password)
        ]);

        $data = [
            'email'    => $agent->email,
            'password' => $password,
        ];

        $response = $this->post(route('agent.login.post'), $data);

        $response->assertRedirect(route('agent.dashboard.index'));
        $this->assertAuthenticatedAs($agent, 'agent');

        $this->get(route('agent.logout'), $data);
        $this->assertGuest();
    }
}
