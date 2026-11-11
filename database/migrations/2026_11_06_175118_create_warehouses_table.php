<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah tabel belum ada, baru buat tabelnya
        if (!Schema::hasTable('warehouses')) {
            Schema::create('warehouses', function (Blueprint $table) {
                $table->id();
                $table->string('warehouse_code')->nullable();
                $table->string('warehouse_name')->nullable();
                $table->string('location_city')->nullable();
                $table->timestamp('created_at')->nullable(); // atau $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};