<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin {
    /**
    * Handle an incoming request.
    *
    * @param  \Closure( \Illuminate\Http\Request ): ( \Symfony\Component\HttpFoundation\Response )  $next
    */

    public function handle( Request $request, Closure $next ) {
        if ( !Auth::check() ) {
            // Redirige al login si no está autenticado
            return redirect()->route( 'login' );
        }

        if ( Auth::user()->role !== 'administrador' ) {
            // Redirige a la página de inicio u otra vista con un mensaje de error si no es administrador
            return redirect()->route( 'dashboard' )->withErrors( 'No tienes permiso para acceder a esta página.' );

        }

        return $next( $request );
    }

}
