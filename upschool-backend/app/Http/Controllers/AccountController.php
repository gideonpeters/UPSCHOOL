<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    public function register(StoreUserRequest $request, UserRepository $userRepository)
    {
        // dd('ddd');
        $user = $userRepository->store($request);

        if (!$user) {
            return response()->json([
                'status' => true,
                'message' => 'Something went wrong',
                'data' => null
            ], 201);
        }

        return response()->json(['user' => $user], 201);
    }
}
