<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Gate;

class CategoryCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * abort users without permission to add new categories
         */
        abort_unless(
            auth()->user()->canDo(User::ADD_CATEGORIES),
            403
        );

        return $next($request);
    }
}
