<?php

namespace Ventrec\LaravelEntitySyncClient\Http\Middleware;

use Closure;

class ResolveGlobalEntity
{
    public function handle($request, Closure $next)
    {
        if (request()->header('X-AUTH-API-TOKEN') !== config('laravelEntitySyncEndpoint.api_auth_token')) {
            return response('Invalid api token.', 401);
        }

        return $next($request);
    }
}
