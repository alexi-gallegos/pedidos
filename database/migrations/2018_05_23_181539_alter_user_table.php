<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('password');
            $table->boolean('isAdmin')->default(false)->after('password');
            $table->integer('id_trabajador')->nullable()->unsigned()->after('isAdmin');
            $table->foreign('id_trabajador')->references('id')->on('trabajadores')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropColumn('isAdmin');
            $table->dropColumn('id_trabajador');
        });
    }
}
