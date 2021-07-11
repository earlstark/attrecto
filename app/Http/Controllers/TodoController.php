<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function add(Request $request) {
        try {
            $todo = new Todo();
            $todo->setAttribute("user_id", $request->post("user_id"));
            $todo->setAttribute("name", $request->post("name"));
            $todo->setAttribute("date", $request->post("date"));
            $todo->save();
            return $this->getTodos($request->post("user_id"));
        } catch (QueryException $e) {
            return json_encode([
                "error" => "You most fill name and date fields",
            ]);
        }
    }

    public function delete($id) {
        $userId = Todo::find($id)->getAttribute("user_id");
        Todo::destroy($id);
        return User::find($userId)->todos()->get();
    }

    private function getTodos($userId) {
        return User::find($userId)->todos()->get();
    }
}
