<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShiftColumnsToUsersTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adding new columns for up to three shifts
            $table->string('shift_name1')->nullable();
            $table->string('shift_time_only1')->nullable();
            $table->string('rest_day1')->nullable();
            $table->string('days1')->nullable();

            $table->string('shift_name2')->nullable();
            $table->string('shift_time_only2')->nullable();
            $table->string('rest_day2')->nullable();
            $table->string('days2')->nullable();

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
            // Dropping new columns
            $table->dropColumn([
                'shift_name1',
                'shift_time_only1',
                'rest_day1',
                'days1',
                'shift_name2',
                'shift_time_only2',
                'rest_day2',
                'days2',
            ]);
        });
    }
}
