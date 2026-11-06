<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ai_demand_forecasts', function (Blueprint $table) {
            $table->id();
            // Menggunakan foreignId otomatis menyamakan tipe data dengan primary key tabel tujuan
            $table->foreignId('sku_id')->constrained('skus')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->date('forecast_date');
            $table->decimal('predicted_demand', 10, 2);
            $table->decimal('confidence_score', 5, 4)->default(0.9500);
            $table->string('model_version', 50)->default('v1.0-pytorch');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ai_demand_forecasts');
    }
};