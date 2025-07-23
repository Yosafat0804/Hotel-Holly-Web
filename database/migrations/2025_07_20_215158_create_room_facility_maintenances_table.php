<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomFacilityMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_facility_maintenances', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id')->unsigned()->nullable();
            $table->string('facility_name')->nullable();
            $table->string('condition')->nullable();
            $table->date('schedule')->nullable();
            $table->text('schedule_note')->nullable();
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
        Schema::dropIfExists('room_facility_maintenances');
    }
}
