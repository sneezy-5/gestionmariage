<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if($request->user()->hasRoles('Admin')) return $next($request);
        else{
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return  redirect()->route('login')->with('error', 'Vous n\'est pas autorisé à accéder à cette page.');
        }
        
    }
}
