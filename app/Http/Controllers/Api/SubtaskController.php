<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubtaskRequest;
use App\Services\SubtaskService;
use Illuminate\Http\JsonResponse;

class SubtaskController extends Controller
{
    public function __construct(
        private readonly SubtaskService $subtaskService
    ) {}

    private function successResponse(
        mixed $data = null,
        string $message = '',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status, [], JSON_UNESCAPED_UNICODE);
    }

    private function errorResponse(
        string $message,
        int $status = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status, [], JSON_UNESCAPED_UNICODE);
    }

    public function index(): JsonResponse
    {
        $subtasks = $this->subtaskService->getAll();

        return $this->successResponse(
            $subtasks,
            'Список підзавдань отримано'
        );
    }

    public function store(SubtaskRequest $request): JsonResponse
    {
        $subtask = $this->subtaskService->create($request->validated());

        return $this->successResponse(
            $subtask,
            'Підзавдання успішно додано до основного завдання',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Підзавдання не знайдено', 404);
        }

        return $this->successResponse(
            $subtask,
            'Підзавдання знайдено'
        );
    }

    public function update(SubtaskRequest $request, int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Підзавдання не знайдено', 404);
        }

        $subtask = $this->subtaskService->update($subtask, $request->validated());

        return $this->successResponse(
            $subtask,
            'Підзавдання успішно оновлено'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Підзавдання не знайдено', 404);
        }

        $this->subtaskService->delete($subtask);

        return $this->successResponse(
            null,
            'Підзавдання видалено'
        );
    }
}
