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
        if (!array_key_exists('title', $request->json())){
            echo 'Need title';
            return;
        }
        $title = $request->json()['title'];
        $rows = $request->json()['rows'];
        foreach($rows as &$row) {
            $row = ['value' => $row, 'checked' => false];
        }
        
        $todo = new Todo();
        
        $todo->title = $title;
        $todo->rows = $rows;

        $todo->save();
        echo json_encode($todo->toArray());
    }

    public static function update(): void
    {
        $request = RequestSingleton::getInstance();
        $args = $request->json();
        $id = $args['id'];
        /** @var Todo $todo */
        $todo = Todo::find($id);
        if (!isset($todo)) {
            echo '404 not found';
            return;
        }
        $todo->title = $args['title'];
        $todo->rows = $args['rows'];
        $todo->save();
        echo json_encode($todo->toArray());
    }
}
