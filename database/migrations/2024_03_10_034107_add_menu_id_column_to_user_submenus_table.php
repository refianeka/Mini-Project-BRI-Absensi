<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenuIdColumnToUserSubmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_submenus', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id')
                ->required()
                ->after('id');
            $table->foreign('menu_id')
                ->references('id')
                ->on('user_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_submenus', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
        });
    }
}
