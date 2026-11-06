<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // Dedicated AI-WMS & API Console</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
        /* Custom Scrollbar for Terminal & History */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<div class="min-h-screen p-4 md:p-8 lg:p-10">
    <div class="max-w-7xl mx-auto space-y-8">
        
    <!-- NAVBAR UTAMA -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">
        <!-- Logo / Brand -->
        <div class="flex items-center space-x-3">
            <span class="w-3 h-3 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-sm font-mono text-white font-bold tracking-wider">ZAINI.DEV // PORTFOLIO</span>
        </div>

        <!-- Menu Navigasi -->
        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
            <a href="/" class="text-slate-400 hover:text-cyan-400 transition-colors">Home</a>
            <a href="#apiPlaygroundSection" class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">FastAPI Playground</a>
            <a href="#chatBoothSection" class="text-slate-400 hover:text-cyan-400 transition-colors">AI Chatbot</a>
            <a href="#metricsSection" class="text-slate-400 hover:text-cyan-400 transition-colors">Chart.js Telemetry</a>
        </div>

        <!-- Tombol Kembali ke Portfolio Utama -->
        <div>
            <a href="/" class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 hover:bg-slate-900 transition-all flex items-center space-x-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Home</span>
            </a>
        </div>
    </nav>
    
        <!-- Header Navigasi & Status -->
        <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-800/80 pb-5">
            <div class="flex items-center space-x-3">
                <a href="/" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 hover:bg-slate-850 transition-all flex items-center space-x-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Portfolio</span>
                </a>
                <span class="text-slate-700">/</span>
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    <h1 class="text-xs md:text-sm font-mono text-slate-300 font-semibold tracking-wide">ZAINI.DEV // AI-WMS & API Playground</h1>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div id="statusBadge" class="text-[11px] font-mono px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-slate-400 flex items-center space-x-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500" id="statusDot"></span>
                    <span id="statusText">SYSTEM IDLE</span>
                </div>
            </div>
        </header>

        <!-- Grid Layout Utama (Kolom Kiri & Kanan Sejajar) -->
        <main class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- KOLOM KIRI: Konfigurasi & Panel Kontrol (Span 5) -->
            <section class="lg:col-span-5 flex flex-col justify-between bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl shadow-2xl h-[860px]">
                <div class="space-y-6">
                    <!-- Tab Kategori API -->
                    <div class="flex rounded-xl bg-slate-950 p-1 border border-slate-800/80">
                        <button type="button" onclick="switchTab('ai-wms')" id="tabAiWms" class="flex-1 py-2 text-xs font-mono rounded-lg bg-cyan-500/15 text-cyan-400 font-medium transition-all border border-cyan-500/30 shadow-sm">AI-WMS & LLM</button>
                        <button type="button" onclick="switchTab('pytorch')" id="tabPytorch" class="flex-1 py-2 text-xs font-mono rounded-lg text-slate-400 hover:text-white transition-all">PyTorch Tensor</button>
                    </div>

                    <!-- Form Konfigurasi Input -->
                    <div class="space-y-4">
                        <div id="warehouseSelectWrapper">
                            <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">Target Warehouse</label>
                            <select id="warehouseSelect" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:outline-none transition-all font-mono">
                                <option value="1">WH-JKT-01 (Central Jakarta)</option>
                                <option value="2">WH-SBY-02 (Surabaya Hub)</option>
                                <option value="3">WH-BDG-03 (Bandung Fulfillment)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">API Endpoint / Route</label>
                            <select id="apiEndpoint" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:outline-none transition-all font-mono">
                                <option value="/api/v1/ai-wms/llm-assistant">POST /api/v1/ai-wms/llm-assistant</option>
                                <option value="/api/v1/ai-wms/forecast/1/1">GET /api/v1/ai-wms/forecast/{wh_id}/{sku_id}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">Prompt / Query Payload</label>
                            <input type="text" id="promptInput" placeholder="Masukkan perintah atau parameter..." value="Analisis status stok dan restok gudang saat ini"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:outline-none transition-all placeholder-slate-600 font-mono">
                        </div>

                        <button id="sendRequestBtn" type="button" onclick="sendAiWmsQuery()"
                            class="w-full py-3.5 px-6 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 transition-all shadow-lg shadow-cyan-500/20 flex items-center justify-center space-x-2 cursor-pointer active:scale-[0.99]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            <span>Kirim Request ke FastAPI Engine</span>
                        </button>
                    </div>
                </div>

                <!-- Bagian Riwayat Request di bagian bawah kolom kiri -->
                <div class="border-t border-slate-800/80 pt-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Execution History</span>
                        <button onclick="clearHistory()" class="text-[10px] font-mono text-rose-400 hover:underline cursor-pointer">Clear Log</button>
                    </div>
                    <div id="historyList" class="space-y-2 max-h-36 overflow-y-auto pr-1 text-xs font-mono">
                        <p class="text-slate-600 italic">Belum ada riwayat eksekusi.</p>
                    </div>
                </div>
            </section>

            <!-- KOLOM KANAN: Terminal Konsol & Visualisasi Grafik (Span 7) -->
            <section class="lg:col-span-7 flex flex-col space-y-6">
                
                <!-- 1. Terminal Konsol Respons -->
                <div class="bg-slate-900 border border-slate-800/90 rounded-2xl overflow-hidden shadow-2xl flex flex-col h-[460px]">
                    <!-- Terminal Header -->
                    <div class="bg-slate-950 px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                            <span class="ml-2 text-xs font-mono text-slate-400">response-console.json</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs font-mono text-cyan-400">
                            <span id="latencyText" class="bg-cyan-500/10 px-2.5 py-0.5 rounded border border-cyan-500/20">Latency: -- ms</span>
                        </div>
                    </div>

                    <!-- Terminal Body Content -->
                    <div class="p-4 flex-1 overflow-y-auto bg-slate-950 font-mono text-xs text-slate-300 leading-relaxed">
                        <pre id="responseConsole" class="whitespace-pre-wrap">// [SYSTEM READY] Menunggu eksekusi perintah ke backend FastAPI (Port 8001)...</pre>
                    </div>

                    <!-- Terminal Footer Status -->
                    <div class="bg-slate-950 px-4 py-2.5 border-t border-slate-800 flex items-center justify-between text-[11px] font-mono text-slate-500">
                        <span>Target: http://127.0.0.1:8001</span>
                        <span id="footerSource" class="text-cyan-400">FastAPI + MySQL + PyTorch</span>
                    </div>
                </div>

                <!-- 2. Panel Live AI Model & Metrics Visualization -->
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                        <div class="flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                            <h3 class="text-xs font-mono text-white uppercase tracking-wider font-semibold">Live Inventory & Tensor Metrics</h3>
                        </div>
                        <span class="text-[10px] font-mono px-2.5 py-0.5 rounded bg-cyan-500/10 text-cyan-400 border border-cyan-500/25">Chart.js Telemetry</span>
                    </div>
                    
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Visualisasi bar chart di bawah memperbarui data jumlah jenis SKU, akumulasi unit fisik, dan status item kritis secara dinamis berdasarkan respons basis data relasional.
                    </p>

                    <!-- Container Grafik Canvas -->
                    <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 h-56 relative flex items-center justify-center">
                        <canvas id="aiMetricsChart"></canvas>
                    </div>
                </div>

            </section>
        </main>

        <!-- CONTAINER CHAT BOOTH AI-WMS (Terpisah Full-Width di Bawah) -->
        <section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl flex flex-col h-[520px]">
            <!-- Header Chat -->
            <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                <div class="flex items-center space-x-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    <h3 class="text-sm font-mono text-slate-200 font-semibold tracking-wide">
                        🤖 ZAINI.DEV // WMS AI Assistant Booth
                    </h3>
                </div>
                <span class="text-[11px] font-mono text-cyan-400 bg-slate-800 px-3 py-1 rounded-full border border-slate-700">
                    Connected to FastAPI & MySQL
                </span>
            </div>

            <!-- Area Percakapan (Chat Messages Box) -->
            <div id="chatMessages" class="flex-1 overflow-y-auto py-4 space-y-4 pr-2 custom-scrollbar">
                <!-- Sambutan Awal dari AI -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/15 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono text-xs">AI</div>
                    <div class="bg-slate-950 border border-slate-800 rounded-xl p-3.5 max-w-[80%] text-xs text-slate-300 font-sans leading-relaxed">
                        Halo! Saya asisten virtual AI-WMS Anda. Silakan pilih gudang dan ajukan pertanyaan seputar status stok, barang kritis, atau analisis inventaris di sini.
                    </div>
                </div>
            </div>

            <!-- Input Form & Tombol Kirim (Dropdown Warehouse Dihilangkan, Input Full-Width) -->
            <div class="pt-4 border-t border-slate-800 flex items-center gap-3">
                <input type="text" id="chatInputPrompt" placeholder="Tanyakan sesuatu, cth: 'Sebutkan nama barang yang ada'..." 
                    class="flex-1 bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-3 font-sans focus:outline-none focus:border-cyan-500 placeholder-slate-600"
                    onkeypress="if(event.key === 'Enter') sendChatBoothQuery()">
                
                <button onclick="sendChatBoothQuery()" id="chatSendBtn" class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-mono font-medium hover:opacity-90 transition-all shadow-lg shadow-cyan-500/20">
                    Kirim Pertanyaan
                </button>
            </div>
            </div>
        </section>

    </div>
</div>

<!-- Script Integrasi Fetch & Chart.js (Revisi & Perbaikan) -->
<script>
    let aiMetricsChart = null;

    document.addEventListener("DOMContentLoaded", () => {
        initAiChart();
    });

    function initAiChart() {
        const ctx = document.getElementById('aiMetricsChart').getContext('2d');
        aiMetricsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Jenis SKU', 'Total Unit Stok', 'Item Kritis (Restock)'],
                datasets: [{
                    label: 'Metrik Operasional AI-WMS',
                    data: [20, 472, 0],
                    backgroundColor: [
                        'rgba(6, 182, 212, 0.6)',  // Cyan
                        'rgba(59, 130, 246, 0.6)',  // Blue
                        'rgba(244, 63, 94, 0.6)'    // Rose
                    ],
                    borderColor: [
                        'rgba(6, 182, 212, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(244, 63, 94, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(51, 65, 85, 0.2)' },
                        ticks: { color: '#94a3b8', font: { family: 'JetBrains Mono', size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { family: 'JetBrains Mono', size: 10 } }
                    }
                }
            }
        });
    }

    async function sendAiWmsQuery() {
        const warehouseId = document.getElementById('warehouseSelect').value;
        const promptQuery = document.getElementById('promptInput').value;
        const endpointSelect = document.getElementById('apiEndpoint').value;
        const outputElement = document.getElementById('responseConsole');
        const latencyText = document.getElementById('latencyText');
        const btn = document.getElementById('sendRequestBtn');
        const statusDot = document.getElementById('statusDot');
        const statusText = document.getElementById('statusText');

        btn.innerText = "Memproses Request...";
        btn.disabled = true;
        outputElement.textContent = "// Mengirim permintaan ke backend FastAPI...";
        
        statusDot.className = "w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping";
        statusText.innerText = "FETCHING...";

        const startTime = performance.now();

        try {
            let response;
            let finalUrl = "";
            
            // Deteksi jenis endpoint (Forecast GET vs LLM Assistant POST)
            if (endpointSelect.includes('forecast') || endpointSelect.includes('monthly-forecast')) {
                // Ambil path dinamis dari dropdown endpoint yang dipilih
                finalUrl = `http://127.0.0.1:8001${endpointSelect.replace('{wh_id}', warehouseId)}`;
                // Jika masih menggunakan format placeholder umum, arahkan ke warehouse_id yang dipilih & sku_id = 1
                if (endpointSelect.includes('{wh_id}') || endpointSelect.includes('{warehouse_id}')) {
                    finalUrl = `http://127.0.0.1:8001/api/v1/ai-wms/forecast/${warehouseId}/1`;
                }
                
                response = await fetch(finalUrl, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });
            } else {
                finalUrl = `http://127.0.0.1:8001${endpointSelect}`;
                response = await fetch(finalUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        warehouse_id: parseInt(warehouseId),
                        prompt_query: promptQuery
                    })
                });
            }

            const endTime = performance.now();
            const latency = Math.round(endTime - startTime);
            latencyText.innerText = `Latency: ${latency} ms`;

            if (!response.ok) {
                throw new Error(`HTTP Error Status: ${response.status} (${response.statusText}) - URL: ${finalUrl}`);
            }

            const data = await response.json();
            outputElement.textContent = JSON.stringify(data, null, 4);

            // Update Grafik jika respons dari LLM Assistant atau endpoint terkait
            if (aiMetricsChart) {
                if (data.database_context) {
                    aiMetricsChart.data.datasets[0].data = [
                        data.database_context.total_sku_types || 20,
                        data.database_context.total_stock_units || 472,
                        data.database_context.total_critical_items || data.database_context.critical_items_count || 0
                    ];
                } else if (data.predicted_demand !== undefined) {
                    // Jika endpoint forecast, kita bisa sesuaikan visualisasi bar chart dengan hasil prediksinya
                    aiMetricsChart.data.datasets[0].data = [
                        data.current_quantity || 15,
                        data.predicted_demand,
                        0
                    ];
                }
                aiMetricsChart.update();
            }

            statusDot.className = "w-1.5 h-1.5 rounded-full bg-emerald-500";
            statusText.innerText = "SUCCESS (200 OK)";
            addHistory(finalUrl, "SUCCESS");

        } catch (error) {
            const endTime = performance.now();
            const latency = Math.round(endTime - startTime); // Diperbaiki dari error pemenggalan baris sebelumnya
            latencyText.innerText = `Latency: ${latency} ms`;
            
            outputElement.textContent = `[ERROR / FAILED]:\nGagal memuat data dari FastAPI.\nDetail: ${error.message}\n\nTips:\n1. Pastikan server Uvicorn berjalan di port 8001.\n2. Pastikan database zaini_ai_wms aktif di port 3308.`;
            
            statusDot.className = "w-1.5 h-1.5 rounded-full bg-rose-500";
            statusText.innerText = "FAILED";
            addHistory(endpointSelect, "ERROR");
        } finally {
            btn.innerText = "Kirim Request ke FastAPI Engine";
            btn.disabled = false;
        }
    }

    function switchTab(type) {
        const tabAi = document.getElementById('tabAiWms');
        const tabPy = document.getElementById('tabPytorch');
        const endpointSelect = document.getElementById('apiEndpoint');

        if (type === 'ai-wms') {
            tabAi.className = "flex-1 py-2 text-xs font-mono rounded-lg bg-cyan-500/15 text-cyan-400 font-medium transition-all border border-cyan-500/30 shadow-sm";
            tabPy.className = "flex-1 py-2 text-xs font-mono rounded-lg text-slate-400 hover:text-white transition-all";
            endpointSelect.innerHTML = `
                <option value="/api/v1/ai-wms/llm-assistant">POST /api/v1/ai-wms/llm-assistant</option>
                <option value="/api/v1/ai-wms/forecast/1/1">GET /api/v1/ai-wms/forecast/{wh_id}/{sku_id}</option>
                <option value="/api/v1/ai-wms/monthly-forecast/1/1">GET /api/v1/ai-wms/monthly-forecast/{wh_id}/{sku_id} (PyTorch Time-Series)</option>
            `;
        } else {
            tabPy.className = "flex-1 py-2 text-xs font-mono rounded-lg bg-cyan-500/15 text-cyan-400 font-medium transition-all border border-cyan-500/30 shadow-sm";
            tabAi.className = "flex-1 py-2 text-xs font-mono rounded-lg text-slate-400 hover:text-white transition-all";
            endpointSelect.innerHTML = `
                <option value="/api/v1/ai-wms/forecast/1/1">GET /api/v1/ai-wms/forecast/{warehouse_id}/{sku_id} (PyTorch Tensor)</option>
                <option value="/api/v1/ai-wms/monthly-forecast/1/1">GET /api/v1/ai-wms/monthly-forecast/{wh_id}/{sku_id} (PyTorch Time-Series)</option>
            `;
        }
    }

    function addHistory(endpoint, status) {
        const historyList = document.getElementById('historyList');
        if (historyList.querySelector('italic')) {
            historyList.innerHTML = '';
        }
        const timeStr = new Date().toLocaleTimeString();
        const badgeColor = status === 'SUCCESS' ? 'text-emerald-400 bg-emerald-500/10' : 'text-rose-400 bg-rose-500/10';
        
        const item = document.createElement('div');
        item.className = "flex items-center justify-between p-2 rounded-lg bg-slate-950 border border-slate-800/60";
        item.innerHTML = `
            <span class="text-slate-300 truncate max-w-[200px]" title="${endpoint}">${endpoint}</span>
            <div class="flex items-center space-x-2">
                <span class="text-[10px] px-1.5 py-0.5 rounded ${badgeColor}">${status}</span>
                <span class="text-slate-500 text-[10px]">${timeStr}</span>
            </div>
        `;
        historyList.prepend(item);
    }

    function clearHistory() {
        document.getElementById('historyList').innerHTML = '<p class="text-slate-600 italic">Belum ada riwayat eksekusi.</p>';
    }


    async function sendChatBoothQuery() {
    const inputField = document.getElementById('chatInputPrompt');
    const chatMessages = document.getElementById('chatMessages');
    const sendBtn = document.getElementById('chatSendBtn');
    
    const userText = inputField.value.trim();
    if (!userText) return;

    // 1. Tampilkan pesan user
    appendMessage(userText, 'user');
    inputField.value = '';
    sendBtn.disabled = true;
    sendBtn.innerText = "Berpikir...";

    // 2. Indikator loading
    const loadingId = 'loading-' + Date.now();
    appendLoadingMessage(loadingId);

    try {
        const response = await fetch('http://127.0.0.1:8001/api/v1/ai-wms/llm-assistant', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                warehouse_id: null, // Berupa null agar AI merespon secara global lintas gudang
                prompt_query: userText
            })
        });

        if (!response.ok) {
            throw new Error(`Gagal terhubung ke server FastAPI (Status: ${response.status})`);
        }

        const data = await response.json();
        document.getElementById(loadingId).remove();

        // 3. Tampilkan jawaban AI
        appendMessage(data.llm_insight, 'ai', data.database_context);

        // Update Chart jika ada data konteks
        if (window.aiMetricsChart && data.database_context) {
            window.aiMetricsChart.data.datasets[0].data = [
                data.database_context.total_sku_types || 0,
                data.database_context.total_stock_units || 0,
                data.database_context.critical_items_count || 0
            ];
            window.aiMetricsChart.update();
        }

    } catch (error) {
        document.getElementById(loadingId).remove();
        appendMessage(`[ERROR]: Tidak dapat memproses permintaan. Pastikan backend FastAPI aktif. (${error.message})`, 'error');
    } finally {
        sendBtn.disabled = false;
        sendBtn.innerText = "Kirim Pertanyaan";
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}

function appendMessage(text, sender, context = null) {
    const chatMessages = document.getElementById('chatMessages');
    const item = document.createElement('div');
    
    if (sender === 'user') {
        item.className = "flex items-start justify-end space-x-3";
        item.innerHTML = `
            <div class="bg-cyan-500/15 border border-cyan-500/30 rounded-xl p-3.5 max-w-[80%] text-xs text-cyan-200 font-sans leading-relaxed">
                ${escapeHtml(text)}
            </div>
            <div class="w-8 h-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-300 font-mono text-xs">Anda</div>
        `;
    } else if (sender === 'ai') {
        let contextHtml = '';
        if (context) {
            contextHtml = `
                <div class="mt-2 pt-2 border-t border-slate-800 text-[10px] font-mono text-slate-400 flex gap-3">
                    <span>SKU Types: <strong class="text-cyan-400">${context.total_sku_types}</strong></span>
                    <span>Total Units: <strong class="text-blue-400">${context.total_stock_units}</strong></span>
                    <span>Kritis: <strong class="text-rose-400">${context.critical_items_count}</strong></span>
                </div>
            `;
        }
        item.className = "flex items-start space-x-3";
        item.innerHTML = `
            <div class="w-8 h-8 rounded-lg bg-cyan-500/15 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono text-xs">AI</div>
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-3.5 max-w-[80%] text-xs text-slate-300 font-sans leading-relaxed">
                ${text}
                ${contextHtml}
            </div>
        `;
    } else {
        // Error message
        item.className = "flex items-start space-x-3";
        item.innerHTML = `
            <div class="w-8 h-8 rounded-lg bg-rose-500/15 border border-rose-500/30 flex items-center justify-center text-rose-400 font-mono text-xs">!</div>
            <div class="bg-rose-950/40 border border-rose-900/50 rounded-xl p-3.5 max-w-[80%] text-xs text-rose-300 font-sans leading-relaxed">
                ${text}
            </div>
        `;
    }

    chatMessages.appendChild(item);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function appendLoadingMessage(id) {
    const chatMessages = document.getElementById('chatMessages');
    const item = document.createElement('div');
    item.id = id;
    item.className = "flex items-start space-x-3";
    item.innerHTML = `
        <div class="w-8 h-8 rounded-lg bg-cyan-500/15 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono text-xs animate-pulse">AI</div>
        <div class="bg-slate-950 border border-slate-800 rounded-xl p-3.5 text-xs text-slate-400 font-mono flex items-center space-x-2">
            <span>Menganalisis data gudang via FastAPI & MySQL</span>
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
        </div>
    `;
    chatMessages.appendChild(item);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function escapeHtml(unsafe) {
    return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
}

</script>

</body>
</html>