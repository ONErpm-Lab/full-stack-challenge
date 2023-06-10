<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Action
{
    protected function asJson($data = null, int $status = 200, string $message = ''): JsonResponse
    {
        return response()->json(['message' => $message, 'data' => $data], $status);
    }

    protected function asHtml(string $view, array $data, int $status = 200): Response
    {
        return response()->view($view, $data, $status);
    }
}
