<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

use App\Models\MasterData\DataStudent;

class DataStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            if ($request->boolean('all')) {
                $data_students = DataStudent::all();
                $message = "Successfully retrieved all data.";
            } else {
                $data_students = DataStudent::paginate(10);
                $message = "Successfully retrieved 10 data.";
            }
            return response()->json(
                [
                    "status" => true,
                    "message" => $message,
                    "data" => $data_students
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
                'nisn' => 'required|string|min:10|max:10|unique:data_student,nisn',
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:L,P',
                'dob' => 'required|date',
                'class_id' => 'required|exists:data_classes,id'
            ]);

            $student = DataStudent::create($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully created data.",
                    "data" => $student
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
    public function show(DataStudent $dataStudent): JsonResponse
    {
        try {
            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully retrieved data.",
                    "data" => $dataStudent
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
    public function update(Request $request, DataStudent $dataStudent): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nisn' => 'required|string|min:10|max:10|unique:data_student,nisn,' . $dataStudent->id,
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:L,P',
                'dob' => 'required|date',
                'class_id' => 'required|exists:data_classes,id'
            ]);

            $dataStudent->update($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully updated data.",
                    "data" => $dataStudent
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
    public function destroy(DataStudent $dataStudent): JsonResponse
    {
        try {
            $dataStudent->delete();

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
