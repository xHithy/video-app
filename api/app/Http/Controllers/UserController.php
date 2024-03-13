<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public static function register(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|string|max:25|unique:users,username',
            'password' => 'required|string|min:8|max:255',
        ]);

        if ($validation->fails()) {
            self::incorrectlyFormattedPayload($validation->errors());
        }

        // Hash the password
        $unhashedPassword = $request->input('password');
        $hashedPassword = Hash::make($unhashedPassword);

        // Create the user
        $newUser = User::create([
            'username' => $request->input('username'),
            'password' => $hashedPassword,
        ]);

        // Create token for new user
        $token = Token::create([
            'token' => Str::random(30),
            'user_id' => $newUser->id,
            'last_used' => time(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Registration successful',
            'token' => $token->token,
        ]);
    }

    public static function login(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            self::incorrectlyFormattedPayload($validation->errors());
        }

        // Check if the password belongs to the username
        $user = User::where('username', $request->input('username'))->first();
        $passwordValid = Hash::check($user->password, $request->input('password'));

        if (!$passwordValid) {
            $errors = ['password' => ['Incorrect password']];
            self::incorrectlyFormattedPayload($errors);
        }

        // Create a token for logged in user
        $token = Token::create([
            'token' => Str::random(30),
            'user_id' => $user->id,
            'last_used' => time(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'token' => $token->token,
        ]);
    }
}
