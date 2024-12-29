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
        Schema::create('stays', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('room_id'); // Foreign key to rooms table
            $table->unsignedBigInteger('guest_id'); // Foreign key to guests table
            $table->date('start_date'); // Start date of the stay
            $table->integer('days'); // Number of days for the stay
            $table->timestamps(); // Adds created_at and updated_at columns
            $table->softDeletes(); // Adds deleted_at column for soft deletes

            // Foreign Key Constraints
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stays');
    }
};
