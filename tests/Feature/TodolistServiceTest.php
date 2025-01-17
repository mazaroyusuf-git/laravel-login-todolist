<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTodolistServiceNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "yusuf");

        $todolist = Session::get("todolist");

        foreach($todolist as $value) {
            self::assertEquals("1", $value["id"]);
            self::assertEquals("yusuf", $value["todo"]);
        }
    }
}
