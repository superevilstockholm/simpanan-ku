<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

use App\Models\Tabungan\DataTabungan;

class DataTabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            if ($request->boolean('all')) {
                $data_tabungan = DataTabungan::with('user')->get();
                $message = "Successfully retrieved all data.";
            } else {
                $data_tabungan = DataTabungan::with('user')->paginate(10);
                $message = "Successfully retrieved 10 data.";
            }

            return response()->json(
                [
                    "status" => true,
                    "message" => $message,
                    "data" => $data_tabungan
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
                'user_id' => 'required|int|exists:users,id',
                'nominal' => 'nullable|numeric|min:0'
            ]);

            $data_tabungan = DataTabungan::create($validated);
            $data_tabungan->load('user');

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully created data.",
                    "data" => $data_tabungan
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
    public function show(DataTabungan $dataTabungan): JsonResponse
    {
        try {
            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully retrieved data.",
                    "data" => $dataTabungan->load('user')
                ]
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
    public function update(Request $request, DataTabungan $dataTabungan): JsonResponse
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|int|exists:users,id',
                'nominal' => 'nullable|numeric|min:0'
            ]);

            $dataTabungan->update($validated);

            return response()->json(
                [
                    "status" => true,
                    "message" => "Successfully updated data.",
                    "data" => $dataTabungan->load('user')
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
    public function destroy(DataTabungan $dataTabungan): JsonResponse
    {
        try {
            $dataTabungan->delete();

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
