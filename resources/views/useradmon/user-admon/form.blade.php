<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    <label for="id" class="col-md-4 control-label">{{ 'Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="id" type="number" id="id" value="{{ $useradmon->id}}" >
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $useradmon->name }}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="text" id="email" value="{{ $useradmon->email}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password" value="" >
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('deparment_id') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Area' }}</label>
    <div class="col-md-6">
        <select name="deparment_id" class="form-control" id="status" required="true">
           <option value="">Seleccione</option>
           <option value="1" {{ (isset($useradmon->deparment_id) && $useradmon->deparment_id == 1) ? 'selected' : ''}}>Chile</option>
           <option value="2" {{ (isset($useradmon->deparment_id) && $useradmon->deparment_id == 2) ? 'selected' : ''}}>Colombia</option>
           <option value="3" {{ (isset($useradmon->deparment_id) && $useradmon->deparment_id == 3) ? 'selected' : ''}}>Panama</option>
           <option value="4" {{ (isset($useradmon->deparment_id) && $useradmon->deparment_id == 4) ? 'selected' : ''}}>Corporate</option>
           <option value="5" {{ (isset($useradmon->deparment_id) && $useradmon->deparment_id == 5) ? 'selected' : ''}}>Costa Rica</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('first_time') ? 'has-error' : ''}}">
    <label for="first_time" class="col-md-4 control-label">{{ 'First Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="first_time" type="number" id="first_time" value="{{ $useradmon->first_time or ''}}" >
        {!! $errors->first('first_time', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="Actualizar">
    </div>
</div>
