<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepo->create($data);
        $apiToken = auth()->login($user);
        // $apiToken = $user->createToken('MyApp');
        return $apiToken;
    }

    public function findByEmail(array $data)
    {
        $user =  $this->userRepo->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'user not found'
            ], 404);
        }


        // $apiToken = $user->createToken("MyApp");
        $apiToken = auth()->login($user);

        return response()->json([
            'status' => 'success',
            'data' => $user,
            'apiToken' => $apiToken
        ]);
    }
}
