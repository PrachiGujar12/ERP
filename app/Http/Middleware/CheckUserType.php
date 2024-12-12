<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // if (Auth::check() && Auth::user()->user_type === $type) {
        //     return $next($request);
        // }
        if (Auth::check()) {
            $userTypes = explode(',', Auth::user()->user_type);
            if (in_array($type, array_map('trim', $userTypes))) {
                return $next($request);
            }
        }
        return response()->view('forbidden', [], 403);
    }
}
