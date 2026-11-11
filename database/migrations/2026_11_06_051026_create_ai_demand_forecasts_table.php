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
        if (!Schema::hasTable('ai_demand_forecasts')) {

            Schema::create('ai_demand_forecasts', function (Blueprint $table) {

                $table->id();

                $table->unsignedBigInteger('sku_id');

                $table->unsignedBigInteger('warehouse_id');

                $table->date('forecast_date');

                $table->decimal(
                    'predicted_demand',
                    10,
                    2
                );

                $table->decimal(
                    'confidence_score',
                    5,
                    4
                )->default(0.9500);

                $table->string(
                    'model_version',
                    50
                )->default('v1.0-pytorch');

                $table->timestamp(
                    'created_at'
                )->useCurrent();

                $table->index('sku_id');

                $table->index('warehouse_id');

                $table->index('forecast_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Rollback sengaja dinonaktifkan
         * untuk menghindari kehilangan data forecast
         * pada environment production.
         */

        if (app()->environment('local')) {

            Schema::dropIfExists(
                'ai_demand_forecasts'
            );
        }
    }
};