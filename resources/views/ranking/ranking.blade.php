@extends('layouts.app')

@section('content')
<script src="{{ asset('js/create_bets.js') }}"></script>
<div class="container" id="generate_bets">
 <input type="hidden" id="_token" value="{{ csrf_token() }}">
 <div class="row">
    @include('admin.sidebar')
    <div class="col-md-9">
        <div class="card">
            <div class="panel-heading"><b>Ranking</b></div>
            <div class="card">
                <div class="card-body bg-warning mb-3">
                  Para puntos iguales, se ordena alfabéticamente y las políticas de desempate serán definidas por Gestión Humana.
                </div>
            </div>
            <div class="panel-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="row">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="pill" href="#ranking_users">Usuarios</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#ranking_deparments">Paises</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#worldcup">Asi va el Mundial</a>
                          </li>
                     </ul>                       
                </div>                                               
            </div>
            <div class="tab-content mt-3">
                <div id="ranking_users" class="container tab-pane active">
                    @if($show==1)
                    @include ('ranking.users_ranking')
                    @else
                    <div class="alert alert-danger">
                      Aun no has participado en ninguno de los partidos, te invitamos a ingresar tus marcadores en los partidos disponibles.
                 </div>
                 @endif


             </div>
             <div id="ranking_deparments" class="container tab-pane">
                @if($show==1)
                @include ('ranking.deparments_ranking')
                @else
                <div class="alert alert-danger">
                 Aun no has participado en ninguno de los partidos, te invitamos a ingresar tus marcadores en los partidos disponibles.
             </div>
             @endif
         </div>
         <div id="worldcup" class="container tab-pane">
            @if($currentuser->email=='admin@sthonore.com.co')
            <div class="row">
                @include ('ranking.upload_file')
            </div>
            @else
            <div class="row">
                @foreach($ranking_worldcup as $image)
                    <img src="{{ mix('storage/app/public/rankingworldcup/'.$image) }}" class="size_worldcup_ranking">
                @endforeach
            </div>
            @endif                  
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
