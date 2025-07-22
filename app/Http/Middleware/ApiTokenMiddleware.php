<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(Request $request, \Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token || mb_strlen($token) !== 64) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $apiToken = ApiToken::whereToken($token)->first();
        if (!$apiToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($apiToken->expires_at && now()->gt($apiToken->expires_at)) {
            return response()->json(['message' => 'Expired token.'], 401);
        }

        $apiToken->update(['last_used_at' => now()]);

        return $next($request);
    }
}
