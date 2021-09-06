<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Super Gestão - @yield('titulo')</title> <!--recebendo os titulos da aba-->
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('css/estilo_basico.css')}}">
        
    </head>

    <body>
        
@include('app.layouts._partials.topo') <!-- chama o topo.blade onde está implementado a barra de menu-->


        <!-- No yield e poderia ter usado apenas um nome pois a pagina web acessara um aview por vez, 
            porem optei por colocar nome diferente -->
    @yield('conteudo')
   


    </body>
    </html>