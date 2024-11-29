<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKurirToPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('kurir')->after('ongkir');
        });
    }
    
    public function down()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            //
        });
    }
};
    

