<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Periksa prefix URL dan arahkan ke halaman login yang sesuai
            if ($request->is('admin/*')) {
                return route('admin.login');
            } elseif ($request->is('influencer/*')) {
                return route('influencer.login');
            } elseif ($request->is('business/*')) {
                return route('business.login');
            }
    
            // Default redirect jika tidak cocok dengan prefix
            return route('login'); // Sesuaikan jika ada halaman login umum
        }
    }
}
