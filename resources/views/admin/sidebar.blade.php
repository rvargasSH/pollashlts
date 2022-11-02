<div class="col-md-3">
    <div class="card">
        <div class="card-header">
           <a href="{{ url('/dashboard') }}">
            Inicio
        </a>
    </div>   
     
    <div class="card-body">
        <ul class="nav flex-column">
            @if($hiddemenu==1)
                <li role="presentation">
                <a href="{{ url('matches/matches') }}">
                    Partidos
                </a>
               </li>
               <li role="presentation">
                   <a href="{{ url('teams/teams') }}">
                       Equipos
                   </a>
               </li>
               <li role="presentation">
                   <a href="{{ url('rounds/rounds') }}">
                       Rondas
                   </a>
               </li>
               <li role="presentation">
                   <a href="{{ url('politicmanager/politic-admin') }}">
                       Politicas Admon
                   </a>
               </li>
               <li role="presentation">
                   <a href="{{ url('UserAdmon/user-admon') }}">
                       Admon Usuarios
                   </a>
                </li>
            @endif
            <li role="presentation" class="nav-item">
                <a href="{{ url('ranking/ranking') }}">
                    Ranking
                </a>
            </li>
            <li role="presentation" class="nav-item"> 
                <a href="{{ url('home/politics') }}">
                    Políticas
                </a>
            </li>       
        </ul>                 
</div>
</div>
</div>
