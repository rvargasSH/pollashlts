@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Partidos</div>
                    <div class="card-body">
                        <a href="{{ url('/matches/matches/create') }}" class="btn btn-success btn-sm" title="Add New match">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>

                        <form method="GET" action="{{ url('/matches/matches') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Fecha</th><th>Hora</th><th>Equipo uno</th><th>Equipo 2</th><th>Marcador</th><th>Estado</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($matches as $item)
                                    <tr>
                                        <td>{{ $item->match_id }}</td><td>{{ $item->match_date }}</td><td>{{ $item->match_hour }}</td>
                                        <td>{{ $item->name_team1 }}</td><td>{{ $item->name_team2 }}</td><td>{{ $item->match_score }}</td>
                                        
                                        <td>@if ($item->status==2)
                                                    Jugado                                                
                                                @else
                                                   Por jugar
                                                @endif 
                                        </td>
                                        <td>
                                            <a href="{{ url('/matches/matches/' . $item->match_id) }}" title="View match"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/matches/matches/' . $item->match_id . '/edit') }}" title="Edit match"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                          
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $matches->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
