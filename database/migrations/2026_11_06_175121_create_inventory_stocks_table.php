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
        Schema::create('inventory_stocks', function (Blueprint $table) {
            $table->integer('id')->nullable();

            $table->integer('warehouse_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('rack_id')->nullable();

            $table->integer('quantity')->nullable();

            $table->integer('min_stock_level')->nullable();
            $table->integer('max_stock_level')->nullable();

            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_stocks');
    }
};
