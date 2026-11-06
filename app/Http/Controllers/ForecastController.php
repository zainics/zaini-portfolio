<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForecastController extends Controller
{
    public function index()
    {
        // Menggunakan koneksi khusus 'mysql_ai' untuk database zaini_ai_wms
        $forecasts = DB::connection('mysql_ai')
            ->table('ai_demand_forecasts as f')
            ->join('skus as s', 'f.sku_id', '=', 's.id')
            ->join('warehouses as w', 'f.warehouse_id', '=', 'w.id')
            ->select(
                'f.id',
                's.product_name',
                'w.warehouse_code',
                'f.forecast_date',
                'f.predicted_demand',
                'f.confidence_score',
                'f.model_version',
                'f.created_at'
            )
            ->orderBy('f.created_at', 'desc')
            ->paginate(15);

        return view('ai-forecasts.index', compact('forecasts'));
    }
}