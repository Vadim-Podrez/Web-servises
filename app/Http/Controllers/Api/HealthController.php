<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'API працює коректно',
            'data' => [
                'status' => 'ok',
                'service' => 'study-planner-api',
            ],
        ]);
    }
}
