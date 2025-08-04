<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

use App\Models\MasterData\DataTeacher;

class DataTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            if ($request->query('all') == true) {
                $data_teachers = DataTeacher::all();
                $message = "Successfully retrieved all data.";
            } else {
                $data_teachers = DataTeacher::paginate(10);
                $message = "Successfully retrieved 10 data.";
            }
            return response()->json(
                [
                    "status" => true,
                    "message" => $message,
                    "data" => $data_teachers
                ], 200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ], 500
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
                'nik' => 'required|string|min:16|max:16|unique:data_teacher,nik',
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:L,P',
                'dob' => 'required|date',
                'class_id' => 'required|exists:data_classes,id'
            ]);

            $teacher = DataTeacher::create($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully created data.",
                    "data" => $teacher
                ], 200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ], 500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataTeacher $dataTeacher): JsonResponse
    {
        try {
            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully retrieved data.",
                    "data" => $dataTeacher
                ], 200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ], 500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataTeacher $dataTeacher)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string|min:16|max:16|unique:data_teacher,nik,' . $dataTeacher->id,
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:L,P',
                'dob' => 'required|date',
                'class_id' => 'required|exists:data_classes,id'
            ]);

            $dataTeacher->update($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully updated data.",
                    "data" => $dataTeacher
                ], 200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ], 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataTeacher $dataTeacher)
    {
        try {
            $dataTeacher->delete();

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully deleted data."
                ], 200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "An error occurred",
                    "error" => $e->getMessage(),
                ], 500
            );
        }
    }
}
