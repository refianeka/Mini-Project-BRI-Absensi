<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id')
                ->required();
            $table->foreign('class_id')
                ->references('id')
                ->on('classes');
            $table->unsignedBigInteger('material_id')
                ->required();
            $table->foreign('material_id')
                ->references('id')
                ->on('materials');
            $table->unsignedBigInteger('assistant_id')
                ->required();
            $table->foreign('assistant_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('code_id')
                ->required();
            $table->foreign('code_id')
                ->references('id')
                ->on('codes');
            $table->string('teaching_role');
            $table->date('date');
            $table->time('start');
            $table->time('end')->nullable();
            $table->integer('duration')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
