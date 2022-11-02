@extends('layouts.app')

@section('content')
<script src="{{  mix('/resources/js/set_points_round.js') }}"></script>
<div class="container">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Asignar Puntos a {{$politicadmin->politic_id}}</div>
                <div class="card-body">
                    <a href="{{ url('/politicmanager/politic-admin') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form method="patch" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">                   
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user_opcion') ? 'has-error' : ''}}">
                            <label for="user_opcion" class="col-md-4 control-label">{{ 'Opc Usuario' }}</label>
                            <div class="col-md-6">
                                <select name="user_opcion" class="form-control" id="user_opcion" required="true">
                                    <option value="">Seleccione</option>
                                    @foreach (json_decode('{"1": "Opcion Uno", "2": "Opcion dos"}', true) as $optionKey => $optionValue)
                                    <option value="{{ $optionKey }}" {{ (isset($politicadmin->user_opcion) && $politicadmin->user_opcion == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                    @endforeach
                                </select> 
                                {!! $errors->first('user_opcion', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('user_opcion') ? 'has-error' : ''}}">
                            <label for="user_opcion" class="col-md-4 control-label">{{ 'Ronda' }}</label>
                            <div class="col-md-6">
                                <select name="round_id" class="form-control" id="round_id" required="true">
                                    <option value="">Seleccione</option>
                                    @foreach ($rounds as $round)
                                    <option value="{{ $round->id }}">{{ $round->name }}</option>
                                    @endforeach
                                </select> 
                                {!! $errors->first('round_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('politic_name') ? 'has-error' : ''}}">
                            <label for="politic_name" class="col-md-4 control-label">{{ 'Nombre' }}</label>
                            <div class="col-md-6">
                                <input type="hidden" name="politic_id" id="politic_id" value="{{ $politicadmin->politic_id}}">
                                <input type="hidden" name="roundpolitic_id" value=""> 
                                <input class="form-control" name="politic_name"  type="text" id="politic_name" value="{{ $politicadmin->politic_name }}" readonly="true">                         
                                {!! $errors->first('politic_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>                        
                        <div class="form-group {{ $errors->has('points') ? 'has-error' : ''}}">
                            <label for="points" class="col-md-4 control-label">{{ 'Puntos' }}</label>
                            <div class="col-md-6">
                                <input class="form-control" name="points" type="number" id="points" value="" >
                                {!! $errors->first('politic_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="button" id="savethepoints" value="Guardar">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
