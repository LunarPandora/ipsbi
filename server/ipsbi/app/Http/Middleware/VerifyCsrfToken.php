<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyCsrfToken
{
    /**
     * The Guard implementation.
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Auth  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Except routes (optional)
        $except = [
            // List routes or route groups that should be excluded from CSRF verification
        ];
        $token = $request->header('token');

        if ($this->isReading($request) || $this->runningUnitTests()) {
            return $next($request);
        }


        if (is_null($token) || !csrf_token() === $token) {
            return response()->json(['error' => 'Invalid CSRF token'], 419);
        }

        return $next($request);
    }

    /**
     * Determine if the request is read only.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading(Request $request)
    {
        return in_array($request->method(), ['GET', 'HEAD', 'OPTIONS']);
    }

    /**
     * Determine if the application is running unit tests.
     *
     * @return bool
     */
    protected function runningUnitTests()
    {
        return app()->environment('testing');
    }
}
