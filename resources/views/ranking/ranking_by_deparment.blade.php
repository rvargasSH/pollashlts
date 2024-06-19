@extends('layouts.app')

@section('content')
@vite(['resources/js/create_bets.js'])
<div class="container" id="generate_bets">
   <input type="hidden" id="_token" value="{{ csrf_token() }}">
   <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="panel-heading">Ranking de:
                    {{ $ranking[0]->deparment }}
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
                                        <th>Participante</th><th>Puntos</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ranking as $points)
                                        <tr>
                                            <td align="center">
                                                    {{$points->user}}
                                            </td>
                                            <td align="center">
                                                    {{$points->points}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
