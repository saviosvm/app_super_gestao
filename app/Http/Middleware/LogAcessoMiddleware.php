<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogAcesso; //trouxemos o model para contexto

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //$request - manipular
      //esse REMOTE_ADDR veio de +serve foi recuperado de um atributo que foi pego usando o dd 
      $ip = $request->server->get('REMOTE_ADDR');
      // foi usado recuperado no dd($request) 
      $rota = $request->getRequestUri();
      LogAcesso::create([
          'log' => "IP $ip requisitou a rota $rota"
      ]);

     // return $next($request);
     $resposta = $next($request);
       
     $resposta->setStatusCode(201,'prestou kkkkkk');
     return $resposta;
    }
}
