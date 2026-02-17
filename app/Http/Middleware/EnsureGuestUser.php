<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EnsureGuestUser
{
    public function handle(Request $request, Closure $next)
    {
        // Check if guest ID exists in session
        if (!$request->session()->has('guest_user')) {
            $guest = [
                'id' => Str::uuid(),
                'name' => 'Guest_' . rand(1000, 9999),
                'messenger_color' => '#'.dechex(rand(0x000000, 0xFFFFFF)),
            ];
            $request->session()->put('guest_user', $guest);
        }

        $guest = (object) $request->session()->get('guest_user');

        // Set a fake user in Auth if no logged-in user
        if (!Auth::check()) {
            Auth::setUser($guest);
        }

        return $next($request);
    }
}
