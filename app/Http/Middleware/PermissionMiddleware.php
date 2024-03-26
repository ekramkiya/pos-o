<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permissions)
    {
        
 
        if($request->user() === null){
            abort(401);
        }



        if($request->user()->role->hasAnyPermission($permissions) || !$permissions){
            return $next($request);
        }

        abort(401);
        
    }
}
