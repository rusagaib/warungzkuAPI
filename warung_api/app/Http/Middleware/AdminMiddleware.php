<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
          if(Auth::user()->roleId != 1){
            return response()->json([
              'massage' => 'UNAUTHORIZED',
            ], 401);
          }
        } catch (QueryException $e) {
            return response()->json([
                'massage' => 'Failed' . $e->errorInfo
            ]);
        }

        return $next($request);
    }
}
