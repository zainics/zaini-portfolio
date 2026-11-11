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
        // Pengecekan agar aman dari error "Table already exists" di Railway/Production
        if (!Schema::hasTable('inventory_stocks')) {
            Schema::create('inventory_stocks', function (Blueprint $table) {
                $table->id(); // Auto-increment Primary Key

                $table->unsignedBigInteger('warehouse_id')->nullable();
                $table->unsignedBigInteger('sku_id')->nullable();
                $table->unsignedBigInteger('rack_id')->nullable();

                $table->integer('quantity')->nullable();

                $table->integer('min_stock_level')->nullable();
                $table->integer('max_stock_level')->nullable();

                $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_stocks');
    }
};