 
 <div class='callout callout-info'>
    <div class="row">
        @foreach ($near_marches as $match)
           @if($match->show==1)
            <div class="col-sm-4" style="border-style: dotted;">
                 <table>
                        <tr>
                            <td align="center">
                                <input type="hidden" name="match_id" class="match_id" value="{{$match->match_id}}">
                                {{$match->name_team1}}
                            </td>
                            <td align="center">{{$match->name_team2}}</td>
                        </tr>
                        <tr>
                            <td align="center" >
                                <img src="{{ mix('/resources/'.$match->flag_team1) }}" class="size_flag_near_match">
                            </td>
                            <td align="center">
                                <img src="{{ mix('/resources/'.$match->flag_team2) }}" class="size_flag_near_match">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                {{$match->match_date}} - {{$match->match_hour}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><strong>Marcadores Op. Uno</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control col-xs-2 score_team_1_opc1" type="number" value="{{$match->score_team1_op1}}" min="0">
                            </td>
                            <td>
                                <input class="form-control col-xs-2 score_team_2_opc1" type="number" value="{{$match->score_team2_op1}}" min="0">
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2" align="center"><strong>Marcadores Op. dos</strong></td>
                        </tr>
                        <tr>
                           <td>
                            <input class="form-control col-xs-2 score_team_1_opc2" type="number" value="{{$match->score_team1_op2}}" min="0">
                        </td>
                        <td>
                            <input class="form-control col-xs-2 score_team_2_opc2" type="number" value="{{$match->score_team2_op2}}" min="0">
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" align="right"><button class="btn btn-success btn-xs savebet">Guardar</button></td>
                    </tr>
                </table>
             </div>
             @endif
            @endforeach
          
    </div>
    <div class="row col-md-12 alert alert-warning">
        <span>La predicción a partir de octavos de final, solo incluye los 90 MINUTOS de tiempo reglamentario más (+) el tiempo de reposición dado por el arbitro, pero EXCLUYE cualquier tiempo adicional (2 x 15 minutos) o el resultado de las series de penaltis.</span>
    </div>
</div>