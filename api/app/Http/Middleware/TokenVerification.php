<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        // Check if the token even exists
        $existingToken = Token::where('token', $token)->first();

        if (! $existingToken) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Check if the token has been used less than 30 minutes ago
        $currentTime = time() / 60;
        $tokenTime = $existingToken->last_used / 60;

        if (($currentTime - $tokenTime) >= 30) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Since token has been used, update last_used
        $existingToken->update([
            'last_used' => now(),
        ]);

        return $next($request);
    }
}
