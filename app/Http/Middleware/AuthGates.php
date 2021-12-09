<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!app()->runningInConsole() && $user) {

            $permissionsArray = [];
            $roles = Role::with('permissions')->get();
            
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->name][] = $role->id;
                }
            }

            foreach ($permissionsArray as $name => $roleId) {
                Gate::define($name, function (User $user) use ($roleId) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roleId)) > 0;
                });
            }
        }

        return $next($request);
    }
}
