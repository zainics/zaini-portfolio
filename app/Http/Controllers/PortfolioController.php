<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ContactMessage;

class PortfolioController extends Controller
{
    public function index()
    {
        // Default data jika Python API sedang tidak aktif
        $apiData = [
            'status' => 'offline',
            'data'   => null
        ];

        try {
            // Ambil data dari FastAPI/Flask Python
            $response = Http::timeout(3)->get(env('PYTHON_API_URL', 'http://127.0.0.1:8000/api/v1') . '/biodata');

            if ($response->successful()) {
                $apiData = $response->json();
            }
        } catch (\Exception $e) {
            // Jika koneksi ke Python API gagal/timeout, halaman tetap bisa dibuka
        }

        return view('landing', compact('apiData'));
    }

    public function storeContact(Request $request)
    {
        // 1. Validasi input dari form kontak
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // 2. Simpan ke database MySQL
            ContactMessage::create($validated);

            // 3. Kembali ke halaman utama dengan pesan sukses
            return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

}