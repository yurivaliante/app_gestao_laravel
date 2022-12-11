<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;

class LogAcessoMiddleware
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
        //$request - manipular

        //dd($request);

        $ip= $request->server->get('REMOTE_ADDR');
        $rota= $request-> getRequestUri();
        LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);

        //return $next($request);
        //return Response('Chegamos no Middleware e finalizamos no proprio Middleware');
        $resposta= $next($request);
        $resposta->setStatusCode(201, 'O status  da resposta e o texto da resposta foram modificados!');

        return $resposta;

    }
}
