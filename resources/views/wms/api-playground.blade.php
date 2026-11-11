<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // FastAPI Playground & Telemetry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<div class="min-h-screen p-4 md:p-8 lg:p-10 space-y-8 max-w-7xl mx-auto">
    
    <!-- NAVBAR UTAMA ANTAR HALAMAN -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">
        <div class="flex items-center space-x-3">
           
            <span class="text-sm font-mono text-white font-bold tracking-wider">ZAINI.DEV // Test Live API</span>
        </div>
        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
            
            <a href="{{ url('/api-playground') }}" class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">FastAPI Playground</a>
            <a href="{{ url('/ai-chat') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">AI Chatbot Booth</a>
            <a href="{{ route('portfolio.ocr-scan') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">OCR Scanner</a>
        </div>
        <div>
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all">Back to Home</a>
        </div>
    </nav>

    <!-- HEADER STATUS -->
    <header class="flex items-center justify-between border-b border-slate-800/80 pb-4">
        <div class="flex items-center space-x-2">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            <h1 class="text-xs md:text-sm font-mono text-slate-300 font-semibold tracking-wide">API PLAYGROUND & TELEMETRY CONSOLE</h1>
        </div>
        <div id="statusBadge" class="text-[11px] font-mono px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-slate-400 flex items-center space-x-2">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-500" id="statusDot"></span>
            <span id="statusText">SYSTEM IDLE</span>
        </div>
    </header>

    <!-- MAIN GRID PLAYGROUND -->
    <main class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- KOLOM KIRI: Kontrol Panel -->
        <section class="lg:col-span-5 flex flex-col justify-between bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl shadow-2xl h-[780px]">
            <div class="space-y-6">
                <div class="flex rounded-xl bg-slate-950 p-1 border border-slate-800/80">
                    <button type="button" class="flex-1 py-2 text-xs font-mono rounded-lg bg-cyan-500/15 text-cyan-400 font-medium border border-cyan-500/30">AI-WMS Engine</button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">Target Warehouse</label>
                        <select id="warehouseSelect" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 font-mono">
                            <option value="1">WH-JKT-01 (Central Jakarta)</option>
                            <option value="2">WH-SBY-02 (Surabaya Hub)</option>
                            <option value="3">WH-BDG-03 (Bandung Fulfillment)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">API Endpoint / Route</label>
                        <select id="apiEndpoint" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 font-mono">
                            <option value="/api/v1/ai-wms/llm-assistant">POST /api/v1/ai-wms/llm-assistant</option>
                            <option value="/api/v1/ai-wms/forecast/1/1">GET /api/v1/ai-wms/forecast/{wh_id}/{sku_id}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">Prompt / Query Payload</label>
                        <input type="text" id="promptInput" value="Sebutkan nama barang yang ada"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 font-mono">
                    </div>

                    <button id="sendRequestBtn" type="button" onclick="sendAiWmsQuery()"
                        class="w-full py-3.5 px-6 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:opacity-90 shadow-lg shadow-cyan-500/20">
                        Kirim Request ke FastAPI Engine
                    </button>
                </div>
            </div>

            <div class="border-t border-slate-800/80 pt-4 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Execution History</span>
                    <button onclick="clearHistory()" class="text-[10px] font-mono text-rose-400 hover:underline">Clear Log</button>
                </div>
                <div id="historyList" class="space-y-2 max-h-32 overflow-y-auto pr-1 text-xs font-mono">
                    <p class="text-slate-600 italic">Belum ada riwayat eksekusi.</p>
                </div>
            </div>
        </section>

        <!-- KOLOM KANAN: Konsol & Grafik Chart.js -->
        <section class="lg:col-span-7 flex flex-col space-y-6">
            <div class="bg-slate-900 border border-slate-800/90 rounded-2xl overflow-hidden shadow-2xl flex flex-col h-[400px]">
                <div class="bg-slate-950 px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400">response-console.json</span>
                    <span id="latencyText" class="text-xs font-mono text-cyan-400 bg-cyan-500/10 px-2.5 py-0.5 rounded border border-cyan-500/20">Latency: -- ms</span>
                </div>
                <div class="p-4 flex-1 overflow-y-auto bg-slate-950 font-mono text-xs text-slate-300">
                    <pre id="responseConsole" class="whitespace-pre-wrap">// [SYSTEM READY] Menunggu eksekusi perintah ke FastAPI...</pre>
                </div>
            </div>

            <div class="bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl shadow-xl space-y-4">
                <h3 class="text-xs font-mono text-white uppercase tracking-wider font-semibold">Live Inventory & Tensor Metrics</h3>
                <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 h-48 relative flex items-center justify-center">
                    <canvas id="aiMetricsChart"></canvas>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Skrip Khusus API Playground -->
<script>
    let aiMetricsChart = null;
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById('aiMetricsChart').getContext('2d');
        aiMetricsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Jenis SKU', 'Total Unit Stok', 'Item Kritis'],
                datasets: [{
                    data: [20, 517, 0],
                    backgroundColor: ['rgba(6, 182, 212, 0.6)', 'rgba(59, 130, 246, 0.6)', 'rgba(244, 63, 94, 0.6)']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    });

   async function sendAiWmsQuery() {
        const warehouseIdVal = document.getElementById('warehouseSelect').value;
        const warehouseId = warehouseIdVal ? parseInt(warehouseIdVal) : null;
        const promptQuery = document.getElementById('promptInput').value.trim();
        const outputElement = document.getElementById('responseConsole');
        const latencyText = document.getElementById('latencyText');
        const sendBtn = document.getElementById('sendRequestBtn');

        if (!promptQuery) return;

        if (sendBtn) {
            sendBtn.disabled = true;
            sendBtn.innerText = "Memproses Agent...";
        }

        const startTime = performance.now();
        try {
            // Menggunakan AI_ENDPOINT yang telah disuntikkan dari config Laravel (.env)
            const res = await fetch(AI_ENDPOINT, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    warehouse_id: warehouseId, 
                    prompt_query: promptQuery 
                })
            });

            const latency = Math.round(performance.now() - startTime);
            latencyText.innerText = `Latency: ${latency} ms`;

            if (!res.ok) throw new Error(`HTTP Error Status: ${res.status}`);

            const data = await res.json();
            outputElement.textContent = JSON.stringify(data, null, 4);

            // Update grafik jika fungsi chart tersedia
            if (typeof aiMetricsChart !== 'undefined' && aiMetricsChart && data.database_context) {
                const whCount = data.database_context.warehouse_count || 0;
                const totalItems = data.database_context.summary?.total_items || 0;
                const totalUnits = data.database_context.summary?.total_units || 0;
                const criticalCount = data.database_context.critical_stocks ? data.database_context.critical_stocks.length : 0;

                aiMetricsChart.data.datasets[0].data = [whCount, totalItems, totalUnits, criticalCount];
                aiMetricsChart.update();
            }

            if (typeof appendHistoryLog === 'function') {
                appendHistoryLog(promptQuery, true);
            }

        } catch (e) {
            const latency = Math.round(performance.now() - startTime);
            latencyText.innerText = `Latency: ${latency} ms`;
            outputElement.textContent = `[ERROR]: Gagal terhubung ke endpoint FastAPI.\nURL: ${AI_ENDPOINT}\nDetail: ${e.message}`;
            
            if (typeof appendHistoryLog === 'function') {
                appendHistoryLog(promptQuery, false);
            }
        } finally {
            if (sendBtn) {
                sendBtn.disabled = false;
                sendBtn.innerText = "Kirim Request ke AI Agent";
            }
        }
    }

    function clearHistory() { 
        document.getElementById('historyList').innerHTML = '<p class="text-slate-600 italic">Belum ada riwayat eksekusi.</p>'; 
    }
</script>
</body>
</html>