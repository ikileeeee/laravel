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
        Schema::create('prognozas', function (Blueprint $table) {
            $table->id();
            $table->integer('temperatura');
            $table->date('dan');
            $table->string('pojava')->nullable();
            $table->string('meteoAlarm')->nullable();
            $table->timestamps();
            $table->foreignId('region_id');
            $table->foreignId('user_id');
            $table->unique(['dan','region_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prognozas');
    }
};
