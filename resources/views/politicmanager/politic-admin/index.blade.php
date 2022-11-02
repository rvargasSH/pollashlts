@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Administracion de Politicas</div>
                    <div class="card-body">
                        <a href="{{ url('/politicmanager/politic-admin/create') }}" class="btn btn-success btn-sm" title="Add New PoliticAdmin">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>

                        <form method="GET" action="{{ url('/politicmanager/politic-admin') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Id</th><th>Descripcion Politica</th><th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($politicadmin as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->politic_id }}</td>
                                        <td>{{ $item->politic_name }}</td>
                                        <td>
                                            <a href="{{ url('/politicmanager/politic-admin/' . $item->politic_id) }}" title="View PoliticAdmin"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/politicmanager/politic-admin/' . $item->politic_id . '/edit') }}" title="Edit PoliticAdmin"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            <a href="{{ url('politicmanager/setpoints/' . $item->politic_id ) }}" title="Points Manageer"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Puntos</button></a>

                                            <form method="POST" action="{{ url('/politicmanager/politic-admin' . '/' . $item->politic_id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete PoliticAdmin" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $politicadmin->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
