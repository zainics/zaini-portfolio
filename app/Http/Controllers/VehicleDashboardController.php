<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleDashboardController extends Controller
{
    public function index()
    {
        // Ubah hasil query menjadi array agar aman dari linter error
        $detections = DB::table('vehicle_detections')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });

        $totalCount = DB::table('vehicle_detections')->count();

        return view('vehicle.dashboard', compact('detections', 'totalCount'));
    }

    public function getLatestCaptures()
    {
        $detections = DB::table('vehicle_detections')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $arr = (array) $item;
                // Ubah path lokal menjadi URL lengkap FastAPI
                $arr['image_path'] = 'http://127.0.0.1:8001/' . $arr['image_path'];
                return $arr;
            });

        $totalCount = DB::table('vehicle_detections')->count();

        return response()->json([
            'status' => 'success',
            'total_count' => $totalCount,
            'data' => $detections
        ]);
    }

    public function captures()
{
    return response()->json(
        DB::table('vehicle_detections')
            ->orderBy('time_detected')
            ->get()
    );
}
}