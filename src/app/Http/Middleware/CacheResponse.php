<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Support\Str;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $this->cachekey($request->url());

        if (Cache::has($key)) {
            return response(Cache::get($key))->header('X-Cache', 'hit');
        }

        $response = $next($request);
        $response->header('X-Cache', 'miss');

        return $response;
    }

    public function terminate($request, $response)
    {
        $key = $this->cachekey($request->url());

        if (!Cache::has($key)) {
            Cache::put($key, $response->getContent(), 60);
        }
    }

    protected function cachekey($url)
    {
        return sprintf("cache:%s", Str::slug($url));
    }
}
