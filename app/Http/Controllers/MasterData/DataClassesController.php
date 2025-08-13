<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

use App\Models\MasterData\DataClasses;

class DataClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit') ?? 10;
            if ($limit === 'all') {
                $data_classes = DataClasses::all();
                $message = "Successfully retrieved all data.";
            } elseif (!ctype_digit($limit) || intval($limit) <= 0) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid 'limit' parameter. Must be a positive integer or 'all'."
                ], 422);
            } else {
                $data_classes = DataClasses::paginate($limit);
                $message = "Successfully retrieved $limit data.";
            }
            return response()->json(
                [
                    "status" => true,
                    "message" => $message,
                    "data" => $data_classes
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
                'name' => 'required|string|max:255|unique:data_classes,name',
                'description' => 'nullable|string|max:255'
            ]);

            $class = DataClasses::create($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully created data.",
                    "data" => [
                        "name" => $class->name,
                        "description" => $class->description
                    ]
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
    public function show(DataClasses $dataClasses): JsonResponse
    {
        try {
            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully retrieved data.",
                    "data" => $dataClasses
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
    public function update(Request $request, DataClasses $dataClasses)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:data_classes,name,' . $dataClasses->id,
                'description' => 'nullable|string|max:255'
            ]);

            $dataClasses->update($validated);
            $dataClasses->refresh();

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully updated data.",
                    "data" => collect($dataClasses)->only(['id', 'name', 'description'])
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
    public function destroy(DataClasses $dataClasses): JsonResponse
    {
        try {
            $dataClasses->delete();

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
