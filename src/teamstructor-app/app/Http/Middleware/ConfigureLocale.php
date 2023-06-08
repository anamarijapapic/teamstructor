<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ConfigureLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('locale')) {
            $locale = $request->get('locale');
            Session::put('locale', $locale);
        }

        if (Session::has('locale') && array_key_exists(Session::get('locale'), config('locales'))) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale(config('app.fallback_locale'));
        }

        return $next($request);
    }
}
