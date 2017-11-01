<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('sub_id');
            $table->string('sub_name');
            $table->string('branch');
            $table->string('category');
            $table->integer('semester');
            $table->integer('marks')->default(100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
