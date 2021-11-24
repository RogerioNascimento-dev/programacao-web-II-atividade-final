<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class TodoService
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function all(Request $request)
    {
        try {

            $user = auth('api')->user();
            return $this->todo
                ->when($request->title, function ($query) use ($request) {
                    return $query->where('title', 'like', '%' . $request->title  . '%');
                })
                ->when($request->description, function ($query) use ($request) {
                    return $query->where('description', 'like', '%' . $request->description  . '%');
                })
                ->where('created_user_id', $user->id)
                ->orderBy('title', 'asc')
                ->get();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function find($id)
    {
        try {
            $user = auth('api')->user();
            $todo = $this->todo
                ->where('created_user_id', $user->id)
                ->find($id);

            if (!$todo) {
                throw new Exception('Todo não localizado!');
            };
            return $todo;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth('api')->user();
            $todo = $this->todo->create([
                'title' => $request->title,
                'description' => $request->description,
                'estimated_date' => $request->estimated_date,
                'created_user_id' => $user->id
            ]);
            return $todo;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function destroy($id)
    {
        try {
            $user = auth('api')->user();
            $todo = $this->todo
                ->where('created_user_id', $user->id)
                ->find($id);
            if (!$todo) {
                throw new Exception('Todo não localizado!');
            };
            $todo->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth('api')->user();
            $todo = $this->todo
                ->where('created_user_id', $user->id)
                ->find($id);
            if (!$todo) {
                throw new Exception('Todo não localizado!');
            };
            $todo->update($request->all());
            return $todo;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function validateStore()
    {
        return Validator::make(request()->all(), $this->todo->rulesStore());
    }
    public function validateUpdate()
    {
        return Validator::make(request()->all(), $this->todo->rulesUpdate());
    }
}
