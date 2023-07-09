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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('time');
            $table->bigInteger('patient_id')->nullable()->unsigned();
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->bigInteger('dentist_id')->nullable()->unsigned();
            $table->foreign('dentist_id')->references('dentist_id')->on('dentists')->onDelete('cascade');
            $table->string('status');
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
        Schema::dropIfExists('appointments');
    }
};
