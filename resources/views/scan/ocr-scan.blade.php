<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // AI-WMS OCR Scanner</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        const AI_ENDPOINT = "{{ config('services.ai_fastapi.endpoint', 'http://127.0.0.1:8001/api/v1/ai-wms/agent-chat') }}";
    </script>


    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<div class="min-h-screen p-4 md:p-8 lg:p-10 space-y-8 max-w-7xl mx-auto flex flex-col">
    
    <!-- NAVBAR UTAMA -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <span class="w-3 h-3 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-sm font-mono text-white font-bold tracking-wider">ZAINI.DEV // OCR MODULE</span>
        </div>
        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
            
            <a href="{{ route('portfolio.api-playground') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">FastAPI Playground</a>
            <a href="{{ route('portfolio.ai-chat') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">AI Chatbot Booth</a>
            <a href="{{ route('portfolio.ocr-scan') }}" class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">OCR Scanner</a>
            <a href="{{ route('portfolio.tradingview') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">External API</a>
        </div>
        <div>
            <a href="{{ route('portfolio.home') }}" class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all">Back to Home</a>
        </div>
    </nav>

    <!-- MAIN CONTENT OCR -->
    <main class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Kolom Kiri: Upload Form -->
        <section class="lg:col-span-5 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
            <div class="border-b border-slate-800 pb-3 flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                <h3 class="text-xs font-mono text-white uppercase tracking-wider font-semibold">Upload Image for OCR</h3>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">Pilih Berkas Gambar (PNG/JPG)</label>
                    <input type="file" id="ocrFile" accept="image/*"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-xs font-mono file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/20 file:text-cyan-400 hover:file:bg-cyan-500/30 transition-all">
                </div>

                <div id="imagePreviewContainer" class="hidden border border-slate-800 rounded-xl p-2 bg-slate-950 flex items-center justify-center h-48">
                    <img id="imagePreview" class="max-h-full rounded-lg object-contain" alt="Preview">
                </div>

                <button onclick="uploadAndScanOcr()" id="ocrSubmitBtn"
                    class="w-full py-3.5 px-6 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:opacity-90 shadow-lg shadow-cyan-500/20 transition-all">
                    Proses Scan OCR
                </button>
            </div>
        </section>

        <!-- Kolom Kanan: Hasil Ekstraksi Teks -->
        <section class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-4 flex flex-col h-[520px]">
            <div class="border-b border-slate-800 pb-3 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    <h3 class="text-xs font-mono text-white uppercase tracking-wider font-semibold">Hasil Ekstraksi Teks (OCR Output)</h3>
                </div>
                <span id="ocrStatus" class="text-[11px] font-mono text-slate-400">Menunggu Berkas...</span>
            </div>

            <div class="flex-1 bg-slate-950 border border-slate-800 rounded-xl p-4 overflow-y-auto font-mono text-xs text-slate-300 leading-relaxed">
                <pre id="ocrResultOutput" class="whitespace-pre-wrap">// [READY] Unggah gambar dokumen/label SKU untuk mulai membaca teks...</pre>
            </div>
        </section>
    </main>

</div>

<!-- Memanggil File Eksternal JavaScript -->
<script src="{{ asset('js/ocr-scan.js') }}"></script>

</body>
</html>