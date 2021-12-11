<?php
namespace App\Controller;

use App\Models\Todo;
use Core\Singleton\RequestSingleton;
use Illuminate\Support\Collection;

class TodoController
{
    public static function allTodos()
    {
        /** @var Collection $todos */
        $todos = Todo::all();
        renderView('todos.html.twig', ['todos' => $todos->toArray()]);
    }

    public static function addTodo()
    {
        $request = RequestSingleton::getInstance();
        if (!array_key_exists('title', $request->get())){
            return;
        }
        $title = $request->get()['title'];
        
        // Todo::all()->each(fn($todo) => $todo->delete());

        $todo = new Todo();
        
        $todo->title = $title;
        $todo->rows = ['stroka','stroka2'];

        $todo->save();
    }
}
