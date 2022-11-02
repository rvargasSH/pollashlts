<div class="form-group {{ $errors->has('politic_name') ? 'has-error' : ''}}">
    <label for="politic_name" class="col-md-4 control-label">{{ 'Nombre' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="politic_name" type="text" id="politic_name" value="{{ $politicadmin->politic_name or ''}}" >
        {!! $errors->first('politic_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('calcule_script') ? 'has-error' : ''}}">
    <label for="calcule_script" class="col-md-4 control-label">{{ 'Numero de Politica' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="politic_number" type="number" id="politic_number" value="{{ $politicadmin->politic_number or ''}}" >
        {!! $errors->first('politic_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
