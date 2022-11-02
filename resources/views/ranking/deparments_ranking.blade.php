 <div class='callout callout-info'>
    <div class="row table-responsive">
       <table class="table">
        <th align="center" width="20%">Posición</th>
        <th align="right" width="30%">Nombre</th>
        <th align="right" width="30%">Promedio</th>
            @for ($i = 0; $i < count($deparments_ranking); $i++)
                <tr>
                    <td align="left">
                        {{$i+1}}                         
                    </td>
                    <td align="left">
                        {{$deparments_ranking[$i]->deparment->name}}
                    </td>
                    <td align="left">
                        {{$deparments_ranking[$i]->points}}
                     </td>                   
                </tr>       
          @endfor      

    </table>         
</div>
</div>
