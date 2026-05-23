<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubtaskRequest;
use App\Models\Subtask;
use Illuminate\Http\JsonResponse;

class SubtaskController extends Controller
{
    public function index(): JsonResponse
    {
        $subtasks = Subtask::with('task')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Список підзавдань отримано',
            'data' => $subtasks,
        ]);
    }

    public function store(SubtaskRequest $request): JsonResponse
    {
        $subtask = Subtask::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Підзавдання успішно додано до основного завдання',
            'data' => $subtask,
        ], 201);
    }

    public function show(Subtask $subtask): JsonResponse
    {
        $subtask->load('task');

        return response()->json([
            'success' => true,
            'message' => 'Підзавдання знайдено',
            'data' => $subtask,
        ]);
    }

    public function update(SubtaskRequest $request, Subtask $subtask): JsonResponse
    {
        $subtask->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Підзавдання успішно оновлено',
            'data' => $subtask->fresh('task'),
        ]);
    }

    public function destroy(Subtask $subtask): JsonResponse
    {
        $subtask->delete();

        return response()->json([
            'success' => true,
            'message' => 'Підзавдання видалено',
            'data' => null,
        ]);
    }
}
