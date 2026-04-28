<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class CheckRole
{
   public function handle(Request $request, Closure $next, $role)
{
    if (auth()->user()->role !== $role) {
        return response()->json(['message' => 'Forbidden Access'], 403);
    }

    return $next($request);
}
}