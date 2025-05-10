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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('room_price_id'); // Foreign key to room_price table
            $table->decimal('discount', 5, 2); // Discount percentage (e.g., 10.00 for 10%)
            $table->date('start_date'); // Promotion start date
            $table->date('end_date'); // Promotion end date
            $table->timestamps(); // Adds created_at and updated_at columns
            $table->softDeletes(); // Adds deleted_at column for soft deletes

            // Foreign Key Constraint
            $table->foreign('room_price_id')->references('id')->on('room_prices')
            ->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
