@extends('layouts.app')

@section('content')
<script src="{{  mix('/resources/js/validate_register.js') }}"></script>
<div class="container">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro</div>

                <div class="panel-body">
                    <form class="form-horizontal" id="register_first_time" method="POST" action="{{ url('updateuser') }}">
                        {{ csrf_field() }}
                        {{-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Numero Identificación</label>

                            <div class="col-md-6">                                
                                <input id="identification_number" type="text" class="form-control" name="identification_id" value="{{ $user->identification_number }}" required autofocus minlength="5" maxlength="50" readonly="true">

                                @if ($errors->has('identification_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identification_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input type="hidden" name="first_time" value="{{$user->first_time}}">
                                <input type="hidden" name="user_updated" value="{{$user->id}}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus minlength="5" maxlength="50" readonly="true">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required readonly="true" maxlength="50">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required maxlength="50">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
