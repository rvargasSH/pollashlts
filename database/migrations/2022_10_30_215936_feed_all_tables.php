<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['name' => 'Grupo A'],
            ['name' => 'Grupo B'],
            ['name' => 'Grupo C'],
            ['name' => 'Grupo D'],
            ['name' => 'Grupo E'],
            ['name' => 'Grupo F'],
            ['name' => 'Grupo G'],
            ['name' => 'Grupo H'],

        ];
        DB::table('groups')->insert($data);

        $data = [
            ['name' => 'Catar', 'file_flag' => 'catar', 'status' => '1', 'group_id' => '1'],
            ['name' => 'Ecuador', 'file_flag' => 'ecuador', 'status' => '1', 'group_id' => '1'],
            ['name' => 'Senegal', 'file_flag' => 'senegal', 'status' => '1', 'group_id' => '1'],
            ['name' => 'Paises Bajos', 'file_flag' => 'paises_bajos', 'status' => '1', 'group_id' => '1'],
            ['name' => 'Inglaterra', 'file_flag' => 'inglaterra', 'status' => '1', 'group_id' => '2'],
            ['name' => 'Irán', 'file_flag' => 'iran', 'status' => '1', 'group_id' => '2'],
            ['name' => 'Estados Unidos', 'file_flag' => 'estados_unidos', 'status' => '1', 'group_id' => '2'],
            ['name' => 'Gales', 'file_flag' => 'gales', 'status' => '1', 'group_id' => '2'],
            ['name' => 'Argentina', 'file_flag' => 'argentina', 'status' => '1', 'group_id' => '3'],
            ['name' => 'Arabia Saudita', 'file_flag' => 'arabia_saudita', 'status' => '1', 'group_id' => '3'],
            ['name' => 'México', 'file_flag' => 'mexico', 'status' => '1', 'group_id' => '3'],
            ['name' => 'Polonia', 'file_flag' => 'polina', 'status' => '1', 'group_id' => '3'],
            ['name' => 'Francia', 'file_flag' => 'francia', 'status' => '1', 'group_id' => '4'],
            ['name' => 'Australia', 'file_flag' => 'australia', 'status' => '1', 'group_id' => '4'],
            ['name' => 'Dinamarca', 'file_flag' => 'dinamarca', 'status' => '1', 'group_id' => '4'],
            ['name' => 'Túnez', 'file_flag' => 'tunez', 'status' => '1', 'group_id' => '4'],
            ['name' => 'España', 'file_flag' => 'espana', 'status' => '1', 'group_id' => '5'],
            ['name' => 'Costa Rica', 'file_flag' => 'costa_rica', 'status' => '1', 'group_id' => '5'],
            ['name' => 'Alemania', 'file_flag' => 'alemania', 'status' => '1', 'group_id' => '5'],
            ['name' => 'Japón', 'file_flag' => 'japon', 'status' => '1', 'group_id' => '5'],
            ['name' => 'Bélgica', 'file_flag' => 'belgica', 'status' => '1', 'group_id' => '6'],
            ['name' => 'Canadá', 'file_flag' => 'canada', 'status' => '1', 'group_id' => '6'],
            ['name' => 'Marruecos', 'file_flag' => 'marruecos', 'status' => '1', 'group_id' => '6'],
            ['name' => 'Croacia', 'file_flag' => 'croacia', 'status' => '1', 'group_id' => '6'],
            ['name' => 'Brasil', 'file_flag' => 'brasil', 'status' => '1', 'group_id' => '7'],
            ['name' => 'Serbia', 'file_flag' => 'serbia', 'status' => '1', 'group_id' => '7'],
            ['name' => 'Suiza', 'file_flag' => 'suiza', 'status' => '1', 'group_id' => '7'],
            ['name' => 'Camerún', 'file_flag' => 'camerun', 'status' => '1', 'group_id' => '7'],
            ['name' => 'Portugal', 'file_flag' => 'portugal', 'status' => '1', 'group_id' => '8'],
            ['name' => 'Ghana', 'file_flag' => 'ghana', 'status' => '1', 'group_id' => '8'],
            ['name' => 'Uruguay', 'file_flag' => 'uruguay', 'status' => '1', 'group_id' => '8'],
            ['name' => 'Corea del sur', 'file_flag' => 'corea_del_sur', 'status' => '1', 'group_id' => '8'],
        ];
        DB::table('teams')->insert($data);

        $data = [
            ['name' => 'Chile'],
            ['name' => 'Colombia'],
            ['name' => 'Panama'],
            ['name' => 'Corporate'],
            ['name' => 'Costa Rica'],

        ];
        DB::table('deparments')->insert($data);

        $data = [
            ['name' => 'Todos contra todos', 'status' => '2'],
            ['name' => 'Octavos de final', 'status' => '2'],
            ['name' => 'Cuartos de final', 'status' => '2'],
            ['name' => 'Semifinal', 'status' => '2'],
            ['name' => 'Final', 'status' => '2'],
            ['name' => 'Amistosos', 'status' => '1'],
        ];
        DB::table('rounds')->insert($data);

        $password = bcrypt('pruebas123');
        $data = [
            ['name' => 'Administrador', 'email' => 'admin@sthonore.com.co', 'password' => $password, 'remember_token' => $password, 'deparment_id' => 2, 'first_time' => 1],
        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};