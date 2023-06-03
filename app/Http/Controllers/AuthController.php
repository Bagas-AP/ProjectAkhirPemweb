<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use \App\Traits\HttpResponses;
use Illuminate\Contracts\Cache\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request) {
        // return 'Login method';

        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', "Invalid credentials", 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request) {
        // return response()->json([
        //     'status' => "Success",
        //     'message' => "Register method",
        //     'data' => []
        // ], 200);

        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> $request->password
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], "User created successfully", 201);
    }

    public function logout() {
        // return 'Logout method';

        Auth::user()->currentAccessToken()->delete();

        return $this->success([], "User logged out successfully");
    }
}
