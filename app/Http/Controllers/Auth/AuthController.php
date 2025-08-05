<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Exception;

use App\Models\User;
use App\Models\MasterData\DataStudent;
use App\Models\MasterData\DataTeacher;
use App\Models\Tabungan\DataTabungan;

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

                $student->update([
                    'user_id' => $user->id
                ]);

                DataTabungan::create([
                    'user_id' => $user->id
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
        try {
            $validated = $request->validate([
                'nik' => 'required|min:16|max:16|unique:data_teacher,nik',
                'dob' => 'required|date',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:128'
            ]);

            $teacher = DataTeacher::where('nik', $validated['nik'])->first();

            if ($teacher && $teacher->dob == $validated['dob']) {
                $validated['password'] = Hash::make($validated['password']);
                $user = User::create([
                    'name' => $teacher->fullname,
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'role' => 'teacher'
                ]);

                $teacher->update([
                    'user_id' => $user->id
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
}
