@extends('layouts.app')

@section('content')
    <script src="{{ mix('/resources/js/create_bets.js') }}"></script>
<div class="container" id="generate_bets">
     <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
                <div class="card">
                <div class="panel-heading">Bienvenidos</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="pill" href="#home">Proximos</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="pill" href="#menu1">Todos</a>
                            </li>
                         </ul>                       
                    </div>
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                            @include ('user_bets.user_bets.near_matchs')
                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                            @include ('user_bets.user_bets.next_matchs')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
