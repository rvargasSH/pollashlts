@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Team {{ $team->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/teams/teams') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button></a>
                        <a href="{{ url('/teams/teams/' . $team->id . '/edit') }}" title="Edit Team"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>                      
                         <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $team->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $team->name }} </td></tr><tr><th> File Flag </th><td> {{ $team->file_flag }} </td></tr><tr><th> Status </th>
                                        <td>@if ($team->status==1)
                                                    Activo                                                
                                                @else
                                                   Eliminado
                                                @endif 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
