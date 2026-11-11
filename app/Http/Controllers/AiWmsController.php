<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiWmsController extends Controller
{
    // Base URL FastAPI Anda (Pastikan port sesuai, misal 8001)
    private $fastApiUrl = 'http://127.0.0.1:8001/api/v1/ai-wms';

    /**
     * Memanggil endpoint PyTorch Monthly Forecast (GET)
     */
    public function getMonthlyForecast($warehouseId, $skuId)
    {
        try {
            // Melakukan HTTP GET request ke FastAPI
            $response = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->get("{$this->fastApiUrl}/monthly-forecast/{$warehouseId}/{sku_id}");

            // Periksa apakah request berhasil (Status 200)
            if ($response->successful()) {
                $data = $response->json();
                
                // Berhasil: Data sudah diproses & disimpan otomatis ke MySQL oleh FastAPI
                return response()->json([
                    'success' => true,
                    'message' => 'Inferensi PyTorch berhasil dan log tersimpan!',
                    'data' => $data
                ]);
            }

            // Jika FastAPI merespons dengan error (misal 404 atau 422)
            Log::error('FastAPI Error Response: ' . $response->body());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data dari FastAPI Engine.',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            // Tangkap error jika FastAPI mati / koneksi menolak (Connection Refused)
            Log::error('FastAPI Connection Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server FastAPI (Port 8001). Pastikan Uvicorn menyala.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memanggil endpoint LLM Assistant (POST)
     */
    public function postLlmAssistant(Request $request)
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|integer',
            'prompt_query' => 'required|string',
        ]);

        try {
            // Melakukan HTTP POST request ke FastAPI
            $response = Http::timeout(15)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post("{$this->fastApiUrl}/llm-assistant", [
                    'warehouse_id' => $validated['warehouse_id'],
                    'prompt_query' => $validated['prompt_query'],
                ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'success' => false,
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Koneksi ke FastAPI gagal.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function playground()
    {
        $aiEndpoint = config('services.ai_fastapi.endpoint');
        return view('portfolio.api-playground', compact('aiEndpoint'));
    }

}