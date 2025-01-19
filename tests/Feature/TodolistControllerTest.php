<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTodolist()
    {
        $this->withSession([
            "user" => "yusuf",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "yusuf"
                ],
                [
                    "id" => "2",
                    "todo" => "azam"
                ]
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("yusuf")
            ->assertSeeText("2")
            ->assertSeeText("azam");
    }

    public function testAddTodolistFailed()
    {
        $this->withSession([
            "user" => "yusuf"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is Required!");
    }

    public function testAddTodolistSuccess()
    {
        $this->withSession([
            "user" => "yusuf"
        ])->post("/todolist", [
            "todo" => "yusuf"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "yusuf",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "yusuf"
                ],
                [
                    "id" => "2",
                    "todo" => "azam"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
