<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id'); // Auto-incrementing integer column for the ID
            $table->string('type'); // Type of notification
            $table->json('data'); // Data associated with the notification
            $table->timestamp('read_at')->nullable(); // Timestamp for when notification was read
            $table->integer('notifiable_id'); // ID of the notifiable user
            $table->string('notifiable_type'); // Type of notifiable model (e.g., User)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Revert the id column type to integer if needed
            $table->id();
        });
    }
}
