<?php

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
            $todos = $todoService->all();
            return response($todos);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 400);
        }
    }
}
