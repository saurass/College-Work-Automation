<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignRoleTable extends Migration
{
    public function up()
    {
        Schema::create('assignroles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fac_id');
            $table->string('sub_id');
            $table->string('branch');
            $table->string('semester');
            $table->string('section');
            $table->string('exam1');
            $table->string('exam2');
            $table->string('exam3');
            $table->string('exam4');
            $table->string('exam5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignroles');
    }
}
