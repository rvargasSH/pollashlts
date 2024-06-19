 <div class='callout callout-info'>
    <div class="row table-responsive">
       <table class="table" class="tablebets">
        <th align="center" width="20%" class="tablebets tableheader">Fecha</th>
        <th align="center" width="30%" class="tablebets tableheader">Equipo Uno</th>
        <th align="center" class="tablebets tableheader">Marcador Op1</th>
        <th align="center" class="tablebets tableheader">Marcador Op2</th>
        <th align="center" width="30%" class="tablebets tableheader">Equipo Dos</th>
        <th align="center" class="tablebets tableheader">Marcador Op1</th>
        <th align="center" class="tablebets tableheader">Marcador Op2</th>

        <th align="center" width="30%" class="tablebets tableheader">Grupo</th>       
        <th align="center" width="20%" class="tablebets tableheader">Acciones</th>
        @foreach ($next_matches as $match)
        @if($match->show==1)
        <tr class="tablebets">
            <td align="left" class="tablebets">{{$match->match_date}} - {{$match->match_hour}}                             
            </td>
            <td align="left" class="tablebets">{{$match->name_team1}}
                <img src="{{ asset('/build/assets/resources/'.$match->flag_team1) }}" class="sizeflag">
                <input type="hidden" name="" class="flag_team1" value="{{ asset('/build/assets/resources/'.$match->flag_team1) }}">
                <input type="hidden" name="" class="match_id" value="{{$match->match_id}}">
                <input type="hidden" name="" class="name_team1" value="{{$match->name_team1}}">
                <input type="hidden" name="" class="score_team_1_opc1" value="{{$match->score_team1_op1}}">
                <input type="hidden" name="" class="score_team_2_opc1" value="{{$match->score_team2_op1}}">
                <input type="hidden" name="" class="score_team_1_opc2" value="{{$match->score_team1_op2}}">
                <input type="hidden" name="" class="score_team_2_opc2" value="{{$match->score_team2_op2}}">
            </td>
            <td align="left" class="tablebets" style=" background-color: #56a5ff;text-align: center;font-size:20px;">
               <strong> {{$match->score_team1_op1}}</strong> 
            </td>
            <td align="left" class="tablebets" style="background-color: #bfbfbf;text-align: center;font-size:20px;">
                <strong>{{$match->score_team1_op2}} </strong> 
            </td>               
            <td align="left" class="tablebets">{{$match->name_team2}}
                <img src="{{ asset('/build/assets/resources/'.$match->flag_team2) }}" class="sizeflag">
                <input type="hidden" name="" class="flag_team2" value="{{ asset('/build/assets/resources/'.$match->flag_team2) }}">
                <input type="hidden" name="" class="name_team2" value="{{$match->name_team2}}">

            </td>
            <td align="left" class="tablebets" style="background-color: #56a5ff;text-align: center;font-size:20px;">
               <strong>{{$match->score_team2_op1}}</strong> 
            </td class="tablebets">
            <td align="left" class="tablebets" style=" background-color: #bfbfbf;text-align: center;font-size:20px;">
               <strong> {{$match->score_team2_op2}} </strong> 
            </td> 
            <td align="left" class="tablebets">{{$match->group_name}}
            </td>
            <td colspan="2" align="left" class="tablebets"><button class="btn btn-success btn-xs showmodal">Jugar</button></td>


        </tr>
        @endif
        @endforeach
    </table> 
    <div class="pagination-wrapper"> {!! $next_matches->appends(['search' => Request::get('search')])->render() !!} </div>        
</div>
<div class="row col-md-12 alert alert-warning">
        <span>La predicción a partir de octavos de final, solo incluye los 90 MINUTOS de tiempo reglamentario más (+) el tiempo de reposición dado por el arbitro, pero EXCLUYE cualquier tiempo adicional (2 x 15 minutos) o el resultado de las series de penaltis.</span>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <table width="100%" align="center">
             <tr>
                <td align="center">
                            <span id="team1_name_modal"></span>
                            <input type="hidden" name="match_id" class="match_id" id="match_id_modal" value="">
                        </td>
                         <td align="center">
                            <span id="team2_name_modal"></span>
                        </td>
                       
            </tr>
        </table>
      </div>
      <div class="modal-body">
         <table width="100%" align="center">
             <tr>
                        <td align="center" id="image_team1_modal"></td>
                        <td align="center" id="image_team2_modal">                   
                        </td>
            </tr>
            <tr>
                        <td colspan="2" align="center"><strong>Marcadores Opcion Uno</strong></td>
            </tr>            
            <tr>
                        <td>
                            <input class="form-control col-xs-2" id="score_team_1_opc1_modal" type="number" value="" min="0">
                        </td>
                        <td>
                            <input class="form-control col-xs-2" id="score_team_2_opc1_modal" type="number" value="" min="0">
                        </td>

            </tr>
            <tr>
                        <td colspan="2" align="center"><strong>Marcadores Opcion Dos</strong></td>
            </tr> 
            <tr>
                     <td>
                        <input class="form-control col-xs-2" id="score_team_1_opc2_modal" type="number" value="" min="0">
                    </td>
                    <td>
                        <input class="form-control col-xs-2" id="score_team_2_opc2_modal" type="number" value="" min="0">
                    </td>

           </tr>
            <tr>
                    <td colspan="2" align="center"><br>
                        <button class="btn btn-success btn-xs" id="savebet">Guardar</button>
                    </td>
            </tr>
         </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>