<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (auth()->user()->expiration_at < Carbon::now()) {
            return $request->wantsJson() ? response()->json(['message' => __('Your account has expired')], 403) : redirect()->route('expiration');
        }

        if(!auth()->user()->hasRole($role)) {
            return $this->accessDenied($request);
        }
        if(!auth()->user()->can($request->route()->getName())) {
            return $this->accessDenied($request);
        }
        if($permission !== null && !auth()->user()->can($permission)) {
            return $this->accessDenied($request);
        }
        return $next($request);
    }

    /**
     * @param $request
     * @return array|void
     */
    private function accessDenied($request)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => __('Access is denied')], 401);
        }
        abort(404);
    }
}
