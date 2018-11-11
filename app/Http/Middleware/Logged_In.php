<?php

namespace App\Http\Middleware;

use Closure;

class Logged_In {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//        $response = $next($request);
//        $response->header('Authorization', $_COOKIE['access_token']);
//        return $response;

        if (empty($_COOKIE['access_token'])) {
            return redirect('/sair');
        }

        return $next($request);
    }
}
