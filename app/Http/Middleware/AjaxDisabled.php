<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

/**
 * AjaxDisabled Middleware
 *
 * @author Antonio Vargas <localhost.80@gmail.com>
 * @copyright 2020 GeekBidz, LLC
 * @package App\Http\Middleware
 */
class AjaxDisabled
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
        if ($request->ajax()) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'AJAX not allowed'
            ]);
        }

        return $next($request);
    }
}
