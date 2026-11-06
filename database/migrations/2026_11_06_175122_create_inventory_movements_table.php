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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->integer('id')->nullable();

            $table->integer('sku_id')->nullable();
            $table->integer('warehouse_id')->nullable();

            $table->string('movement_type')->nullable();
            $table->integer('quantity')->nullable();

            $table->string('reference_number')->nullable();

            $table->dateTime('movement_date')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
