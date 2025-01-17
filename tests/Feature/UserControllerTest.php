<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->get("/login")->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "yusuf"
        ])->get("/login")
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "user" => "yusuf",
            "password" => "1234"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "yusuf");
    }

    public function testLoginUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "yusuf"
        ])->post("/login", [
                "user" => "yusuf",
                "password" => "1234"
            ])->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])
            ->assertSeeText("user or password cannot empty");
    }

    public function testLoginFailed()
    {
        $this->post("login", [
            "user" => "salah",
            "password" => "salah"
        ])->assertSeeText("user or password wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "yusuf"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post("/logout")
                ->assertRedirect("/");
    }
}
