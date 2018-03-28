<?php

namespace App\FLA\Core\Middleware;
use Exception;
use Closure;

abstract class CoreMiddleware
{
    abstract protected function beforeRequest($request);
    abstract protected function afterRequest($request);

    public function handle($request, Closure $next)
    {

        try {
            //handle before request here
            $result = $this->beforeRequest($request);
            if($result!=null && $result!='') {
                return $result;
            }

            // request
            $response = $next($request);

            //handle after request here
            $this->afterRequest($request);

            return $response;

        } catch (Exception $e) {
            return response()->json([
                'status' => 'UNAUTHORIZED',
                'message' => $e->getMessage()
            ]);
        }
    }
}