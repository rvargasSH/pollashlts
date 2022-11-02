@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Round {{ $round->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/rounds/rounds') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button></a>
                        <a href="{{ url('/rounds/rounds/' . $round->id . '/edit') }}" title="Edit Round"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>                        
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $round->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $round->name }} </td></tr>
                                    <tr><th> Estado </th><td> {{ $round->status }} </td></tr>
                                    <tr><th> Valores Politicas Opción Uno </th></tr>
                                    <tr><th> Marcador Pleno </th><td> {{ $round->pol_1_op1 }} </td></tr>
                                    <tr><th> Empate </th><td> {{ $round->pol_2_op1 }} </td></tr>
                                    <tr><th> Marcador Equi 1 </th><td> {{ $round->pol_3_op1 }} </td></tr>
                                    <tr><th> Marcador Equi 2 </th><td> {{ $round->pol_4_op1 }} </td></tr>
                                    <tr><th> Valores Politicas Opción Dos </th></tr>
                                    <tr><th> Marcador Pleno </th><td> {{ $round->pol_1_op2 }} </td></tr>
                                    <tr><th> Empate </th><td> {{ $round->pol_2_op2 }} </td></tr>
                                    <tr><th> Marcador Equi 1 </th><td> {{ $round->pol_3_op2 }} </td></tr>
                                    <tr><th> Marcador Equi 2 </th><td> {{ $round->pol_4_op2 }} </td></tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
