<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserIdHeader
{
    // Check User-Id header in requests
    public function handle($request, Closure $next)
    {
        if ($request->header('User-Id')) {
            return $next($request);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User-Id header is missing'
            ], 400);
        }
    }
}
