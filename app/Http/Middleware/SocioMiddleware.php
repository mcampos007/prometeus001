<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocioMiddleware {
    /**
    * Handle an incoming request.
    *
    * @param  \Closure( \Illuminate\Http\Request ): ( \Symfony\Component\HttpFoundation\Response )  $next
    */

    public function handle( Request $request, Closure $next ): Response {

        if ( !$request->user() ) {
            abort( 403, 'Acceso no autorizado.' );
        }

        // Ejemplo utilizando el método hasRole:
        if ( !$request->user()->hasRole( 'socio' ) ) {
            abort( 403, 'Acceso no autorizado.' );
        }
        return $next( $request );
    }
}
