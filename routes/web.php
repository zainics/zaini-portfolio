<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AiWmsController;
use App\Http\Controllers\ForecastController;

// ==========================================
// 1. RUTE HALAMAN UTAMA (PORTFOLIO)
// ==========================================
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.home');

// ==========================================
// 2. RUTE MODUL WMS (API PLAYGROUND & AI CHAT)
// ==========================================
// Halaman Khusus API Playground & Telemetry
Route::get('/api-playground', function () {
    return view('wms.api-playground');
})->name('portfolio.api-playground');


// Halaman Khusus AI Chat Booth / Assistant
Route::get('/ai-chat', function () {
    return view('wms.ai-chat');
})->name('portfolio.ai-chat');


// ==========================================
// 3. RUTE KONTAK & LAYANAN BACKEND LARAVEL
// ==========================================
Route::post('/contact/send', [PortfolioController::class, 'storeContact'])->name('contact.send');


// ==========================================
// 4. RUTE INTEGRASI AI & FORECAST (FASTAPI BRIDGE)
// ==========================================
Route::get('/ai/forecast/{warehouse}/{sku}', [AiWmsController::class, 'getMonthlyForecast']);
Route::post('/ai/llm-assistant', [AiWmsController::class, 'postLlmAssistant']);
Route::get('/ai/forecasts-history', [ForecastController::class, 'index'])->name('ai.forecasts.index');

// ==========================================
// 4. RUTE SCAN OCR
// ==========================================
Route::get('/ocr-scan', function () {
    return view('scan.ocr-scan');
})->name('portfolio.ocr-scan');