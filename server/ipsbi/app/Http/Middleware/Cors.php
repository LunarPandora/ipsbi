<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        header("Access-Control-Allow-Origin: ");

        $headers = [
            'Access-Control-Allow-Methods' => 'GET, PUT, POST, DELETE, OPTIONS, post, get',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization, x-requested-with',
            "Access-Control-Allow-Credentials" => 'true'
        ];
        if ($request->getMethod() == "OPTIONS") {
            return response('OK')
                ->withHeaders($headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value)
            $response->header($key, $value);
        
        return $response;
    }
}

