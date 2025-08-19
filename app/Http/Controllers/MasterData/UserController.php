<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\MasterData\DataStudent;
use App\Models\MasterData\DataTeacher;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit') ?? 10;
            if ($limit === 'all') {
                $data_users = User::all();
                $message = "Successfully retrieved all data.";
            } elseif (!ctype_digit($limit) || intval($limit) <= 0) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid 'limit' parameter. Must be a positive integer or 'all'."
                ], 422);
            } else {
                $data_users = User::paginate($limit);
                $message = "Successfully retrieved $limit data.";
            }
            return response()->json(
                [
                    "status" => true,
                    "message" => $message,
                    "data" => $data_users
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|in:student,teacher,admin',
                'password' => 'required|string|min:8|max:128',
            ]);
            $validated['password'] = Hash::make($validated['password']);
            if ($validated['role'] === 'student') {
                $req = $request->validate([
                    'student_id' => 'required|exists:data_student,id'
                ]);
                $student = DataStudent::find($req['student_id']);
                if ($student->user_id) {
                    return response()->json([
                        "status" => false,
                        "message" => "Student already has a user account"
                    ], 400);
                }
                $user = User::create($validated);
                $student->update(['user_id' => $user->id]);
            } elseif ($validated['role'] === 'teacher') {
                $req = $request->validate([
                    'teacher_id' => 'required|exists:data_teacher,id'
                ]);
                $teacher = DataTeacher::find($req['teacher_id']);
                if ($teacher->user_id) {
                    return response()->json([
                        "status" => false,
                        "message" => "Teacher already has a user account"
                    ], 400);
                }
                $user = User::create($validated);
                $teacher->update(['user_id' => $user->id]);
            } else {
                $user = User::create($validated);
            }
            return response()->json([
                "status" => true,
                "message" => "User berhasil dibuat",
                "data" => collect($user)->only(['id', 'name', 'email', 'role'])
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        try {
            if ($user->role === 'student') {
                $student = DataStudent::where('user_id', $user->id)->with('class')->first();
                $user['student'] = $student;
            } elseif ($user->role === 'teacher') {
                $teacher = DataTeacher::where('user_id', $user->id)->with('class')->first();
                $user['teacher'] = $teacher;
            }

            return response()->json([
                "status" => true,
                "message" => "Successfully retrieved data.",
                "data" => $user
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
                'role' => 'sometimes|required|in:student,teacher,admin',
                'password' => 'nullable|string|min:8|max:128',
            ]);

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            DataStudent::where('user_id', $user->id)->update(['user_id' => null]);
            DataTeacher::where('user_id', $user->id)->update(['user_id' => null]);

            if (isset($validated['role'])) {
                if ($validated['role'] === 'student') {
                    $req = $request->validate([
                        'student_id' => 'required|exists:data_student,id'
                    ]);
                    $student = DataStudent::find($req['student_id']);

                    if ($student->user_id && $student->user_id !== $user->id) {
                        return response()->json([
                            "status" => false,
                            "message" => "Student already linked with another user account"
                        ], 400);
                    }
                    $student->update(['user_id' => $user->id]);
                } elseif ($validated['role'] === 'teacher') {
                    $req = $request->validate([
                        'teacher_id' => 'required|exists:data_teacher,id'
                    ]);
                    $teacher = DataTeacher::find($req['teacher_id']);

                    if ($teacher->user_id && $teacher->user_id !== $user->id) {
                        return response()->json([
                            "status" => false,
                            "message" => "Teacher already linked with another user account"
                        ], 400);
                    }
                    $teacher->update(['user_id' => $user->id]);
                }
            }

            $user->update($validated);

            return response()->json([
                "status" => true,
                "message" => "User berhasil diperbarui",
                "data" => collect($user)->only(['id', 'name', 'email', 'role'])
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            if ($user->role === 'student') {
                DataStudent::where('user_id', $user->id)->update(['user_id' => null]);
            } elseif ($user->role === 'teacher') {
                DataTeacher::where('user_id', $user->id)->update(['user_id' => null]);
            }

            $user->delete();

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully deleted data."
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }
}
