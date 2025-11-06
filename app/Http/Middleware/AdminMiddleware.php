<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Aqui você define como identificar um admin
        // Ex: verifica se o email é admin
        if (!$request->user() || !$request->user()->is_admin) {
            return Inertia::render('login'); // ou redirect para login
        }

        return $next($request);
    }
}
