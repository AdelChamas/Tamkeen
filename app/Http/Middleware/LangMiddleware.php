<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class LangMiddleware{
    public function handle(Request $request, Closure $next){
        $language = session('language');

        app()->setLocale($language);

        return $next($request);
    }
}
