<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarketingCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('marketing') && ($request->path() != '/')) {
            return redirect('/')->with('fail', 'Vous devez être connecté');
        }

        if (session()->has('marketing') && ($request->path() == '/')) {
            return redirect('/marketing/home');
        }
        return $next($request)->header('cache-control','no-store, max-age=0, must-revalidate',)
                            ->header('Pragma','no-cache')
                            ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');
    }
}
