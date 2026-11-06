<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ai_demand_forecasts', function (Blueprint $table) {
            $table->id();
            $table->integer('sku_id');
            $table->integer('warehouse_id');
            $table->date('forecast_date');
            $table->decimal('predicted_demand', 10, 2);
            $table->decimal('confidence_score', 5, 4)
                ->default(0.9500);
            $table->string('model_version', 50)
                ->default('v1.0-pytorch');
            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ai_demand_forecasts');
    }
};