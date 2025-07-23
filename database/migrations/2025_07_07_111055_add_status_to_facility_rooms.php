<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToFacilityRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facility_rooms', function (Blueprint $table) {
            $table->boolean('status')->after('facility_name')->default(true);
            // atau gunakan ->default(1) jika kamu lebih suka angka
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_rooms', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}