<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ProfileController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty($request->session()->get('user'))){
            return redirect('/');
        }
        
        if($request->session()->get('user')[0]->id_profile != ProfileController::$PROFILE_ADMINISTRATOR)
        {
            return redirect('/');
        }      

        return $next($request);
    }
}
