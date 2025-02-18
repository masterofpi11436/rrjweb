<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClearCache
{
    /**
     * Handle an incoming request and prevent page caching.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Ensure we apply headers to prevent back button caching
        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0, s-maxage=0')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
    }
}
