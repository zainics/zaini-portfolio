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
        if (!Schema::hasTable('inventory_movements')) {
            Schema::create('inventory_movements', function (Blueprint $table) {
                $table->id(); // Auto-increment Primary Key

                $table->unsignedBigInteger('sku_id')->nullable();
                $table->unsignedBigInteger('warehouse_id')->nullable();

                $table->string('movement_type')->nullable(); // Contoh: 'IN' atau 'OUT'
                $table->integer('quantity')->nullable();

                $table->string('reference_number')->nullable();

                $table->dateTime('movement_date')->nullable();
                
                $table->timestamps(); // Mencatat created_at dan updated_at secara otomatis
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};