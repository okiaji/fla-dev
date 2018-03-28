<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTPersonType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_person_type', function (Blueprint $table) {
            $table->bigIncrements('person_type_id');
            $table->string('person_type_code', 50)->unique();
            $table->string('person_type_name', 100);
            $table->string('person_type_desc', 1024);
            $table->string('create_datetime', 14);
            $table->string('update_datetime', 14);
            $table->bigInteger('create_user_id');
            $table->bigInteger('update_user_id');
            $table->bigInteger('version');
            $table->string('active', 1);
            $table->string('active_datetime', 14);
            $table->string('non_active_datetime', 14);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_person_type');
    }
}
