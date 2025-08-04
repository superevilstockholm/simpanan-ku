<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\MasterData\DataStudent;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|max:128'
            ]);

            $user = User::where('email', $request->email)->first();

            if (Hash::check($validated['password'], $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Login success',
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role
                    ]
                ], 200)->cookie(
                    'auth_token',
                    $token,
                    60 * 24 * 7,
                    '/', // path
                    null, // domain
                    false, // secure
                    false, // httponly
                    'Lax' // samesite
                );
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Login failed, invalid credentials',
                    'data' => null
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while logging in',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function studentRegister(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'nisn' => 'required|min:10|max:10|unique:data_student,nisn',
                'dob' => 'required|date',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:128'
            ]);

            $student = DataStudent::where('nisn', $request->nisn)->first();

            if ($student && $student->dob == $validated['dob']) {
                $validated['password'] = Hash::make($validated['password']);
                $user = User::create([
                    'name' => $student->fullname,
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'role' => 'student'
                ]);

                return response()->json(
                    [
                        "status" => true,
                        "message" => "Successfully registered",
                        "data" => [
                            "name" => $user->name,
                            "email" => $user->email,
                            "role" => $user->role
                        ]
                    ], 200
                );
            } else {
                return response()->json(
                    [
                        "status" => false,
                        "message" => "Failed to register, invalid credentials",
                        "data" => null
                    ], 400
                );
            }
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred while registering",
                    "error" => $e->getMessage(),
                ], 500
            );
        }
    }

    public function teacherRegister(Request $request) {
        //
    }
}
