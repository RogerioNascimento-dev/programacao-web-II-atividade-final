<?php

namespace App\Services;

use App\Models\Todo;
use Exception;

class TodoService
{
    protected $todo;
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function all()
    {
        try {
            return $this->todo
                ->orderBy('title', 'asc')
                ->get();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
