<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterShiftColumnInAttendanceSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_summary', function (Blueprint $table) {
            $table->string('shift')->nullable()->change(); // Make shift nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_summary', function (Blueprint $table) {
            $table->string('shift')->default('Day Shift')->change(); // Revert to default if needed
        });
    }
}
