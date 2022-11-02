
<input class="form-control" name="match_id" type="hidden" id="match_id" value="{{ isset($match->match_id)  or ''}}" >
<div class="form-group {{ $errors->has('id_team1') ? 'has-error' : ''}}">
    <label for="id_team1" class="col-md-4 control-label">{{ 'Equipo uno' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="id_team1" type="date" id="id_team1" required="true">
            <option value=""> Seleccione</option>           
            @foreach ($teams as $team)
            <option value="{{ $team->id }}" {{ (isset($match->id_team1) && $match->id_team1 == $team->id) ? 'selected' : ''}}> {{ $team->name }}</option> 
            @endforeach
        </select>        
    </div>
</div>
<div class="form-group {{ $errors->has('id_team2') ? 'has-error' : ''}}">
    <label for="id_team2" class="col-md-4 control-label">{{ 'Equipo Dos' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="id_team2" type="date" id="id_team2" required="true" >
            <option value=""> Seleccione</option>
             @foreach ($teams as $team)
            <option value="{{ $team->id }}" {{ (isset($match->id_team2) && $match->id_team2 == $team->id) ? 'selected' : ''}}> {{ $team->name }}</option> 
            @endforeach
        </select>        
    </div>
</div>
<div class="form-group {{ $errors->has('match_date') ? 'has-error' : ''}}">
    <label for="match_date" class="col-md-4 control-label">{{ 'Fecha Partido' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="match_date" type="date" id="match_date" value="{{ $match->match_date}}" required="true">
        {!! $errors->first('match_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('match_hour') ? 'has-error' : ''}}">
    <label for="match_hour" class="col-md-4 control-label">{{ 'Hora Partido' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="match_hour" type="time" id="match_hour" value="{{ $match->match_hour}}" required="true">
        {!! $errors->first('match_hour', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('round_id') ? 'has-error' : ''}}">
    <label for="round_id" class="col-md-4 control-label">{{ 'Fase' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="round_id" type="date" id="round_id" required="true">
            @foreach($rounds as $round)
                <option value="{{ $round->id}}" {{ (isset($match->round_id) && $match->round_id== $round->id) ? 'selected' : ''}}> {{ $round->name }}</option>
            @endforeach 
        </select>        
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
    <select class="form-control" name="status" type="date" id="status">
            <option value="1" selected="true">Por Jugar</option>
            <option value="2" {{ (isset($match->status) && $match->status == 2) ? 'selected' : ''}}>Jugado</option>
    </select>  
    </div>
</div><div class="form-group {{ $errors->has('score_one_team1') ? 'has-error' : ''}}">
    <label for="score_one_team1" class="col-md-4 control-label">{{ 'Marcador Equipo Uno' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="score_team1" type="number" id="score_team1" value="{{ isset($match->score_team1) or ''}}">
        {!! $errors->first('score_team1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('score_team2') ? 'has-error' : ''}}">
    <label for="score_team2" class="col-md-4 control-label">{{ 'Marcador Equipo dos' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="score_team2" type="number" id="score_team2" value="{{ isset($match->score_team2) or ''}}" >
        {!! $errors->first('score_team2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="Actualizar">
    </div>
</div>
