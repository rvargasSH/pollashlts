@extends('layouts.app')

@section('content')
@vite(['resources/js/create_bets.js'])
<div class="container" id="generate_bets">
   <input type="hidden" id="_token" value="{{ csrf_token() }}">
   <div class="row">
    @include('admin.sidebar')
    <div class="col-md-9">
        <div class="card">
            <div class="panel-heading">Politicas</div>

            <div class="panel-body">
               @if (session('status'))
               <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="row">
                <ul class="nav nav-pills" role="tablist">                   
                    <li><a data-toggle="tab" class="nav-link active" href="#generalpolitics">Generales</a></li>                  
                    <li><a data-toggle="tab" class="nav-link" href="#aditionalpolitics">Adicionales</a></li>                  
                 </ul>                       
            </div>
            <div class="tab-content">
                @for ($i = 0; $i <1; $i++)
                <div id="generalpolitics" class="container tab-pane active">
                    <table class="table">
                        <th>No Politica</th><th>Descripción</th><th>Puntos Op. 1</th><th>Puntos Op. 2</th>                        
                        @for ($a = 0; $a < count($rounds[$i]->politics); $a++)
                        <tr>
                            <td>
                                {{$a+1}}
                            </td>
                            <td>
                               {{$rounds[$i]->politics[$a]['politic_name']}} 
                            </td>
                            <td>
                               {{$rounds[$i]->politics[$a]['points_op_one']}} 
                            </td>
                            <td>
                               {{$rounds[$i]->politics[$a]['points_op_two']}} 
                            </td>
                        </tr>
                        @endfor  
                    </table>
                </div>
                @endfor
                <div id="aditionalpolitics" class="tab-pane fade">
                     <table class="table">
                        <tr>
                            <td>
                                    1. Para puntos iguales, se ordena alfabéticamente y las políticas de desempate serán definidas por Gestión Humana.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                     2. Si se encuentra que un mismo participante tiene mas de un registro en la Polla Saint Honore,se le dejara activo el usuario que tenga menos puntos y los demas seran eliminados.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    3. Los partidos estaran habilitados hasta una hora antes de su inicio, posterior a este tiempo no se podran ingresar ni modificar marcadores.
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                    4. 30 Minutos antes de cada partido, se enviara un correo que contendra un archivo excel con los resultados ingresados por cada uno de los participantes.
                            </td>
                        </tr> --}}
                    </table>                    
                </div>
            </div>


        </div>

    </div>
    <div class="row col-md-12 alert alert-warning">
        <span>La predicción a partir de octavos de final, solo incluye los 90 MINUTOS de tiempo reglamentario más (+) el tiempo de reposición dado por el arbitro, pero EXCLUYE cualquier tiempo adicional (2 x 15 minutos) o el resultado de las series de penaltis.</span>
    </div>
</div>
</div>
</div>
 
@endsection
