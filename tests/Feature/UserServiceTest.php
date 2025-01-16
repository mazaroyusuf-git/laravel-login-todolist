<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("yusuf", "1234"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("gakada", "gakada"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("yusuf", "salah"));
    }
}
