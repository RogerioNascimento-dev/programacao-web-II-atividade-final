<?php
/*
    * Instituição: Unime
    * Curso: Sistemas de informação
    * Disciplina: Programação Web II
    * Professor:Pablo Roxo
    * Aluno: Rogério de Oliveira Nascimento
*/

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TodoService;
use Exception;

class TodoController extends Controller
{

    public function index(Request $request, TodoService $todoService)
    {
        try {
            $todos = $todoService->all($request);
            return response($todos);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 400);
        }
    }
    public function show(Request $request, TodoService $todoService, $id)
    {
        try {
            $todo = $todoService->find($id);
            return response($todo);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 404);
        }
    }
    public function store(Request $request, TodoService $todoService)
    {
        try {
            $validator = $todoService->validateStore($request);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $todo = $todoService->store($request);
            return response($todo, 201);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 400);
        }
    }
    public function update(Request $request, TodoService $todoService, $id)
    {
        try {
            $validator = $todoService->validateUpdate($request);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $todo = $todoService->update($request, $id);
            return response($todo);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 400);
        }
    }
    public function destroy(Request $request, TodoService $todoService, $id)
    {
        try {
            $todo = $todoService->destroy($id);
            return response('', 204);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 404);
        }
    }
}
