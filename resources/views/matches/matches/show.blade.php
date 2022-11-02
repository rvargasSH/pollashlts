@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">match {{ $match->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/matches/matches') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button></a>
                        <a href="{{ url('/matches/matches/' . $match->id . '/edit') }}" title="Edit match"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>                                    
                                    <tr><th> Id </th><td> {{ $match->match_id }} </td></tr>
                                    <tr><th> Fecha </th><td> {{ $match->match_date }} </td></tr>
                                    <tr><th> Hora </th><td> {{ $match->match_hour }} </td></tr>
                                    <tr><th> Equipo Uno </th><td> {{ $teams1_name }} </td></tr>
                                    <tr><th> Equipo Dos </th><td> {{ $teams2_name }} </td></tr>
                                    <tr><th> Round </th><td> {{ $round->name }} </td></tr>
                                    <tr><th> Marcador Equipo Uno </th><td> {{ $match->score_team1 }} </td></tr>
                                    <tr><th> Marcador Equipo Dos </th><td> {{ $match->score_team2 }} </td></tr>
                                    <tr><th> Estado </th><td> {{ $match->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
