<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request): Response
    {
        $todolist = $this->todolistService->getTodolist();
        return response()->view("todolist.todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todolist = $this->todolistService->getTodolist();

        $todo = $request->input("todo");
        if(empty($todo)) {
            return response()->view("todolist". [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is Required!"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([
            TodolistController::class, "todolist"
        ]);
    }

    public function removeTodo(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([
            TodolistController::class, "todolist"
        ]);
    }
}
