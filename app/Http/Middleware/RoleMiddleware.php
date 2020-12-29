<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use App\Traits\HasRolesAndPermissions;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        $user = auth()->user();
        if ($user == null){
            abort(404);
        }
//dd($user);

        if(!auth()->user()->hasRole($role)) {
            abort(404);
        }
        if($permission !== null && !auth()->user()->can($permission)) {
            abort(404);
        }
        return $next($request);
    }
}
