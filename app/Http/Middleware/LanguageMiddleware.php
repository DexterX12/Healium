<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response | RedirectResponse
    {

        if (session()->has('app_locale')) {
            App::setLocale(session('app_locale'));
        }

        return $next($request);
    }
}
