<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserType;

class UserAccess
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userType = Auth::user()->type;

            // Convert roles to UserType enum
            $roleEnums = array_map(fn($role) => UserType::from($role), $roles);

            if (in_array($userType, $roleEnums)) {
                return $next($request);
            }
        }

        return response()->json(['You do not have permission to access for this page.']);
    }
}
