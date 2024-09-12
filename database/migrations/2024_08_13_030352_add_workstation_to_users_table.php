<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Make the workstation column nullable first
            $table->string('workstation')->nullable()->change();
            
            // Then set the default value for new entries
            $table->string('workstation')->default('Unknown')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // You can decide to reverse the change by either dropping the column or changing it back
            $table->string('workstation')->nullable(false)->default(null)->change();
        });
    }
};
