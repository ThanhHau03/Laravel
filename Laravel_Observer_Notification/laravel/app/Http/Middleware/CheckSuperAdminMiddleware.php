<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('level') === '0') {
            throw new \Exception('Dung co xoa ma, dung lai di');
        }

        return $next($request);
    }
}
