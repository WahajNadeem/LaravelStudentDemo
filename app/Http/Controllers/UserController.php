<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    function login(Request $req)
    {
       $validate =  $req->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        return $this->userService->findByEmail($validate);
    }

    function signUp(Request $req)
    {
        $validate = $req->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Student added successfully',
            'apiToken'    => $this->userService->createUser($validate)
        ], 201);
    }
}
