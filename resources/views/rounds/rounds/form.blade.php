
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Nombre' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $round->name or ''}}" required="true" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status" required="true">
    @foreach (json_decode('{"1": "Activo","2": "Pendiente", "3": "Finalizado"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($round->status) && $round->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row col-md-12" align="center" style="margin-left: 20px;margin-top: 10px;margin-bottom: 10px;">
    <span style="border:double;padding-left: 20px;padding-right: 20px;">Valores Politicas Opción Uno</span>
</div>
<div class="form-group {{ $errors->has('pol_1_op1') ? 'has-error' : ''}}">
    <label for="pol_1_op1" class="col-md-4 control-label">{{ 'Marcador Pleno' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_1_op1" type="number" id="pol_1_op1" value="{{ $round->pol_1_op1 or ''}}" required="true">
        {!! $errors->first('pol_1_op1', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_2_op1') ? 'has-error' : ''}}">
    <label for="pol_2_op1" class="col-md-4 control-label">{{ 'Empate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_2_op1" type="number" id="pol_2_op1" value="{{ $round->pol_2_op1 or ''}}" required="true">
        {!! $errors->first('pol_2_op1', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_3_op1') ? 'has-error' : ''}}">
    <label for="pol_3_op1" class="col-md-4 control-label">{{ 'Marcador Equi 1' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_3_op1" type="number" id="pol_3_op1" value="{{ $round->pol_3_op1 or ''}}" required="true">
        {!! $errors->first('pol_3_op1', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_4_op1') ? 'has-error' : ''}}">
    <label for="pol_4_op1" class="col-md-4 control-label">{{ 'Marcador Equi 2' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_4_op1" type="number" id="pol_4_op1" value="{{ $round->pol_4_op1 or ''}}" required="true">
        {!! $errors->first('pol_4_op1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row col-md-12" align="center" style="margin-left: 20px;margin-top: 10px;margin-bottom: 10px;">
    <span style="border:double;padding-left: 20px;padding-right: 20px;">Valores Politicas Opción Dos</span>
</div>
<div class="form-group {{ $errors->has('pol_1_op2') ? 'has-error' : ''}}">
    <label for="pol_1_op2" class="col-md-4 control-label">{{ 'Marcador Pleno' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_1_op2" type="number" id="pol_1_op2" value="{{ $round->pol_1_op2 or ''}}" required="true">
        {!! $errors->first('pol_1_op2', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_2_op2') ? 'has-error' : ''}}">
    <label for="pol_2_op2" class="col-md-4 control-label">{{ 'Empate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_2_op2" type="number" id="pol_2_op2" value="{{ $round->pol_2_op2 or ''}}" required="true">
        {!! $errors->first('pol_2_op2', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_3_op2') ? 'has-error' : ''}}">
    <label for="pol_3_op2" class="col-md-4 control-label">{{ 'Marcador Equi 1' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_3_op2" type="number" id="pol_3_op2" value="{{ $round->pol_3_op2 or ''}}" required="true">
        {!! $errors->first('pol_3_op2', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pol_4_op2') ? 'has-error' : ''}}">
    <label for="pol_4_op2" class="col-md-4 control-label">{{ 'Marcador Equi 2' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pol_4_op2" type="number" id="pol_4_op2" value="{{ $round->pol_4_op2 or ''}}" required="true">
        {!! $errors->first('pol_4_op2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
