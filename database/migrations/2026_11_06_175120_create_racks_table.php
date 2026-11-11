<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hanya buat tabel jika belum ada di database
        if (!Schema::hasTable('racks')) {
            Schema::create('racks', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warehouse_id')->nullable();
                $table->string('rack_code')->nullable();
                $table->string('zone')->nullable();
                $table->integer('aisle')->nullable();
                $table->integer('level')->nullable();
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('racks');
    }
};
