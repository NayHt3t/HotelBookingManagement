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
        Schema::create('room_prices', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('room_type_id'); // Foreign key to room_types
            $table->unsignedBigInteger('price_type_id'); // Foreign key to pricetypes
            $table->decimal('price', 10, 2); // Room price with up to 10 digits and 2 decimal places
            $table->timestamps(); // Adds created_at and updated_at columns
            $table->softDeletes(); // Adds deleted_at column for soft deletes

            // Foreign Key Constraints
            $table->foreign('room_type_id')->references('id')
            ->on('room_types')->onDelete('cascade');
            $table->foreign('price_type_id')->references('id')
            ->on('price_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_prices');
    }
};
