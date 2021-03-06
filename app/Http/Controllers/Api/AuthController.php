<?php
/*
    * Instituição: Unime
    * Curso: Sistemas de informação
    * Disciplina: Programação Web II
    * Professor:Pablo Roxo
    * Aluno: Rogério de Oliveira Nascimento
*/

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'token_type' => 'bearer'
        ]);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
}
