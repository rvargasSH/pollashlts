@extends('layouts.app')

@section('content')
@vite(['resources/js/create_bets.js'])
<div class="container" id="generate_bets">
   <input type="hidden" id="_token" value="{{ csrf_token() }}">
   <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="panel-heading">Puntos De:
                     {{ $user_bets[0]->user_name }}
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif                        
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ronda</th><th>Equipo Uno</th><th>Equipo Dos</th><th>Resultado</th><th>Su Resultado Op1</th><th>Su Resultado Op2</th><th>Puntos</th><th></th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_bets as $points)
                                        <tr>
                                            <td align="center">
                                                    {{$points->round_name}}
                                            </td>
                                            <td align="center">
                                                    {{$points->team1_name}}
                                            </td>
                                            <td align="center">
                                                    {{$points->team2_name}}
                                            </td>
                                            <td align="center">
                                                   {{$points->score_team1}} - {{$points->score_team2}}
                                            </td>
                                            <td align="center">
                                                {{$points->score_team1_op1}} - {{$points->score_team2_op1}}
                                            </td>
                                            <td align="center">
                                                {{$points->score_team1_op2}} - {{$points->score_team2_op2}}
                                            </td>
                                            <td align="center">
                                                {{$points->points}}
                                            </td>
                                            <td>
                                                <a href="{{ url('home/politics') }}">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Politicas</button>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $user_bets->appends(['search' => Request::get('search')])->render() !!} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
