<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login() {
        return "This is my login";
    }
    public function register(StoreUserRequest $storeUserRequest) {

        $storeUserRequest->validated($storeUserRequest->all());

        $user = User::create([
            'name' => $storeUserRequest->name,
            'email' => $storeUserRequest->email,
            'password' => Hash::make($storeUserRequest->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }
    public function logout() {
        return response()->json("This is");
    }
}
