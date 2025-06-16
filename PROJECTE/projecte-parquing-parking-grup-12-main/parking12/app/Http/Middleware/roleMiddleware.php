<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role )
    {
        $user = $request->user();

        //Si és admin, té accés a tot.
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Si es manager, només pot accedir al seu parking assignat
        if ($user->role === 'manager') {
            $parkingId = $request->route('parking');
            $parkingId = is_object($parkingId) ? $parkingId->id : $parkingId;
        
            if ($user->parking_id !== $parkingId) {
                abort(403, 'Acceso no autorizado');
            }


        if ($request->user()->role === $role) {

           return $next($request);

       } 

       abort(403,'Accés no autoritzat');
    }

    }

}
