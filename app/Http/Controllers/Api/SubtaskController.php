<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SubtaskRequest;
class SubtaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Subtask::all());
    }

    public function store(SubtaskRequest $request): JsonResponse
    {
        $subtask = Subtask::create($request->validated());
        return response()->json($subtask, 201);
    }

    public function show(Subtask $subtask): JsonResponse
    {
        return response()->json($subtask);
    }

    public function update(SubtaskRequest $request, Subtask $subtask): JsonResponse
    {
        $subtask->update($request->validated());
        return response()->json($subtask);
    }

    public function destroy(Subtask $subtask): JsonResponse
    {
        $subtask->delete();
        return response()->json(['message' => 'Subtask deleted successfully']);
    }
}
