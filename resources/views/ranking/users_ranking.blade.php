 <div class='callout callout-info'>
    <div class="row table-responsive">
       <table class="table">
        <th align="center" width="20%">Posicion</th>
        <th align="right" width="30%">Nombre</th>
        <th align="right" width="30%">Puntos</th>
        <th align="right" width="30%">Partidos Apostados</th>
        @if($user_position<=10)
            @for ($i = 0; $i < $totalregister; $i++)
                <tr @if($user_ranking->user_id==$rankingUsers[$i]->user_id) class="alert alert-info" @endif>
                    <td align="left">{{$rankingUsers[$i]->position}}                         
                    </td>
                    <td align="left">{{$rankingUsers[$i]->name}}
                       
                    </td>
                    <td align="left">             
                        <a href="{{ url('/ranking/ranking/' . $rankingUsers[$i]->user_id . '/edit') }}" title="Edit match">{{$rankingUsers[$i]->points}}</a>
                    </td>
                    <td align="left">{{$rankingUsers[$i]->bets}}
                    </td>
                </tr>            
            @endfor
        @else
           @for ($i = 0; $i < $totalregister; $i++)
            <tr>
                <td align="left">{{$rankingUsers[$i]->position}}                         
                </td>
                <td align="left">{{$rankingUsers[$i]->name}}
                   
                </td>
                <td align="left">             
                        <a href="{{ url('/ranking/ranking/' . $rankingUsers[$i]->user_id . '/edit') }}" title="Edit match">{{$rankingUsers[$i]->points}}</a>
                </td>
                <td align="left">{{$rankingUsers[$i]->bets}}
                </td>
            </tr>            
            @endfor
            <div>
                <tr class="alert alert-info">
                    <td align="left">{{$user_position}}                         
                    </td>
                    <td align="left">{{$user_ranking->name}}
                       
                    </td>
                    <td align="left">             
                        <a href="{{ url('/ranking/ranking/' .$user_ranking->id . '/edit') }}" title="Edit match">{{$user_ranking->points}}</a>
                    </td>
                    <td align="left">{{$user_ranking->bets}}
                    </td>
                </tr>  
            </div>     
        @endif

    </table>         
</div>
</div>
