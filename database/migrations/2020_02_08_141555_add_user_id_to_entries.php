<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entries', function (Blueprint $table) {
            // Sqlite won't let you add a NOT NULL column to a table that already has
            // columns in it, but it will happily let you add a nullable column that
            // you then _change_ to be NOT NULL.
            $table->integer('user_id')->nullable();
            $table->integer('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entries', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
