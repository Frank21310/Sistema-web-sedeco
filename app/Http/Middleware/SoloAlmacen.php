<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class SoloAlmacen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        switch (auth::user()->rol_id) {
            case ('1'):
                return redirect('Administrador'); //Admin
                break;
            case ('2'):
                return $next($request); //Almancen
                break;
                case ('3'):
                return redirect('Peticiones');//Requirente
                break;
            case ('4'):
                return redirect('Transportes');//Almacen
                break;
    
        }
    }
}
