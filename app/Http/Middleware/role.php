<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\levelAkses;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $menu)
    {
      if (Auth::check()) {
        $cek = levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', $menu)->get();
            if(sizeof($cek)==1 && $cek[0]->r==1){
              return $next($request);
            } else {
              return response(view('errors.accessdenied'));
            }
        }
    }
}
