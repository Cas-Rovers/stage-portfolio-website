<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('languages.available', []);
        $defaultLocale = config('app.locale', 'en');

        if (Session::has('locale')) {
            $sessionLocale = Session::get('locale');

            if (array_key_exists($sessionLocale, $availableLocales)) {
                App::setLocale($sessionLocale);
            } else {
                App::setLocale($defaultLocale);
                Session::forget('locale');
            }
        } else {
            App::setLocale($defaultLocale);
        }

        return $next($request);
    }
}
