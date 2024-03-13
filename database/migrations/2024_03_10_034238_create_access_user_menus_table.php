<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessUserMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_user_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')
                ->required();
            $table->foreign('role_id')
                ->references('id')
                ->on('user_roles');
            $table->unsignedBigInteger('menu_id')
                ->required();
            $table->foreign('menu_id')
                ->references('id')
                ->on('user_menus');
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
        Schema::dropIfExists('access_user_menus');
    }
}
