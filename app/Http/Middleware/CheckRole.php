<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $section): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login-form');
        }

        if (!$user->hasAccessTo($section)) {
            if ($user->isPanoramaManager()) {
                return redirect()->route('admin-panoramas');
            }

            abort(403, 'У вас нет доступа к этому разделу.');
        }

        return $next($request);
    }
}
