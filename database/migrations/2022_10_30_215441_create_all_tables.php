<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('matches');
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('match_id');
            $table->timestamps();
            $table->date('match_date');
            $table->time('match_hour');
            $table->string('status');
            $table->integer('id_team1');
            $table->integer('id_team2');
            $table->integer('round_id');
            $table->integer('score_team1')->nullable();
            $table->integer('score_team2')->nullable();
        });
        Schema::dropIfExists('teams');
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('file_flag');
            $table->integer('group_id');
            $table->integer('puntos')->nullable();
            $table->string('status');
        });
        Schema::dropIfExists('rounds');
        Schema::create('rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('status');
        });
        Schema::create('user_bets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('match_id');
            $table->integer('score_team1_op1');
            $table->integer('score_team2_op1');
            $table->integer('score_team1_op2');
            $table->integer('score_team2_op2');
            $table->integer('points')->nullable();
        });
        Schema::dropIfExists('groups');
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });
        Schema::dropIfExists('sessions');
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });
        Schema::dropIfExists('raking_user');
        Schema::create('raking_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->string('points');
        });

        Schema::dropIfExists('raking_deparment');
        Schema::create('raking_deparment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('deparment_id');
            $table->string('points');
        });
        Schema::dropIfExists('deparments');
        Schema::create('deparments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('deparment_id')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('first_time')->default(0);
        });
        Schema::table('raking_user', function (Blueprint $table) {
            $table->dropColumn('points');
        });
        Schema::table('raking_user', function (Blueprint $table) {
            $table->integer('points');
        });
        Schema::table('raking_deparment', function (Blueprint $table) {
            $table->dropColumn('points');
        });
        Schema::table('raking_deparment', function (Blueprint $table) {
            $table->decimal('points', 5, 2);
        });
        Schema::dropIfExists('politics');
        Schema::create('politics', function (Blueprint $table) {
            $table->increments('politic_id');
            $table->timestamps();
            $table->string('politic_name');
            $table->integer('politic_number');
            $table->integer('status');
        });
        Schema::dropIfExists('round_politics');
        Schema::create('round_politics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_round');
            $table->integer('id_politic');
            $table->integer('user_opcion');
            $table->integer('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matches');
        Schema::drop('teams');
        Schema::drop('rounds');
        Schema::drop('user_bets');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('sessions');
        Schema::drop('raking_user');
        Schema::drop('raking_deparment');
        Schema::drop('deparments');
        Schema::drop('politics');
        Schema::drop('round_politics');
    }
};