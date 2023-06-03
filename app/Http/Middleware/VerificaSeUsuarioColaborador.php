<?php

namespace App\Http\Middleware;

use App\Http\Controllers\PerfilController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaSeUsuarioColaborador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty($request->session()->get('usuario'))){
            return redirect('/');
        }

        if($request->session()->get('usuario')[0]->id_perfil != PerfilController::$PERFIL_COLABORADOR)
        {
            return redirect('/');
        }   
        
        return $next($request);
    }
}
