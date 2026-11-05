<section id="api-tester" class="py-20 bg-slate-950 border-t border-slate-800/80 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-mono font-semibold tracking-widest text-emerald-400 uppercase bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
                Interactive API Playground
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4">
                Test Live Python API & MySQL Data
            </h2>
            <p class="text-slate-400 mt-3 text-base">
                Coba uji langsung komunikasi real-time dari frontend Laravel ke backend Python (FastAPI/Flask) yang mengambil data langsung dari tabel database MySQL.
            </p>
        </div>

        <!-- Playground Grid Container -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Panel: Endpoint Controls & Parameters -->
            <div class="lg:col-span-5 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-cyan-400"></i> Request Configuration
                </h3>

                <!-- Endpoint Selector -->
                <div class="space-y-2">
                    <label class="text-xs font-mono text-slate-400 uppercase">Pilih Endpoint API Python</label>
                    <select id="api-endpoint" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm font-mono text-cyan-300 focus:outline-none focus:border-cyan-500">
                        <option value="profile">GET /api/v1/biodata (MySQL Profile)</option>
                        <option value="skills">GET /api/v1/skills (Tech Stack List)</option>
                        <option value="ping">GET /api/v1/ping (Server Latency Check)</option>
                    </select>
                </div>

                <!-- Input Parameter Tambahan (Opsional) -->
                <div class="space-y-2">
                    <label class="text-xs font-mono text-slate-400 uppercase">Payload / Query Param (Opsional)</label>
                    <input type="text" id="api-param" placeholder="e.g. ?format=json" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-sm font-mono text-slate-200 focus:outline-none focus:border-cyan-500">
                </div>

                <!-- Action Button -->
                <button onclick="executeLiveApiTest()" id="btn-send-api" class="w-full py-3 px-6 rounded-xl font-semibold bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-lg shadow-cyan-500/20 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-play text-xs"></i> Kirim Request ke Python API
                </button>
            </div>

            <!-- Right Panel: Response Output Console -->
            <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden flex flex-col h-[400px]">
                
                <!-- Terminal Header Bar -->
                <div class="bg-slate-950 px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                        <span class="ml-2 text-xs font-mono text-slate-400">response-console.json</span>
                    </div>
                    <div id="api-status-badge" class="text-xs font-mono px-2.5 py-0.5 rounded bg-slate-800 text-slate-400">
                        IDLE
                    </div>
                </div>

                <!-- Terminal Body (JSON Output) -->
                <div class="p-4 bg-slate-950/90 flex-1 overflow-y-auto font-mono text-xs sm:text-sm">
                    <pre id="api-response-output" class="text-slate-400"><code>// Klik tombol "Kirim Request ke Python API" di samping untuk melihat respons data asli dari MySQL melalui backend Python...</code></pre>
                </div>

                <!-- Terminal Footer Status -->
                <div class="bg-slate-950 px-4 py-2 border-t border-slate-800 flex justify-between items-center text-[11px] font-mono text-slate-400">
                    <span>Latency: <strong id="api-latency" class="text-white">-- ms</strong></span>
                    <span>Source: <strong class="text-amber-400">MySQL DB</strong></span>
                </div>

            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
    async function executeLiveApiTest() {
        const endpoint = document.getElementById('api-endpoint').value;
        const outputEl = document.getElementById('api-response-output');
        const statusBadge = document.getElementById('api-status-badge');
        const latencyEl = document.getElementById('api-latency');
        const btnSend = document.getElementById('btn-send-api');

        // Ubah state UI menjadi loading
        btnSend.disabled = true;
        btnSend.innerHTML = `<i class="fa-solid fa-spinner fa-spin mr-2"></i> Memproses...`;
        statusBadge.innerText = "PENDING";
        statusBadge.className = "text-xs font-mono px-2.5 py-0.5 rounded bg-amber-500/20 text-amber-400 font-bold";
        outputEl.innerHTML = `<span class="text-slate-500">// Mengirim HTTP Request ke Backend Python...</span>`;

        const startTime = performance.now();

        try {
            // Catatan: Ganti URL di bawah ini dengan URL backend Python kamu (misal: http://127.0.0.1:8000/api/v1/...)
            // Untuk demonstrasi portofolio mandiri, kita simulasikan respons sukses lengkap dengan format JSON data dari MySQL:
            await new Promise(resolve => setTimeout(resolve, 600)); 

            let mockResponse = {};
            if(endpoint === 'profile') {
                mockResponse = {
                    status: "success",
                    code: 200,
                    source_database: "MySQL (table: users_biodata)",
                    data: {
                        name: "Fullstack Developer",
                        role: "Backend Python & Laravel Specialist",
                        location: "Indonesia",
                        status: "Active & Available"
                    }
                };
            } else if(endpoint === 'skills') {
                mockResponse = {
                    status: "success",
                    code: 200,
                    source_database: "MySQL (table: tech_stacks)",
                    data: [
                        { tech: "Python", framework: "FastAPI / Flask", category: "Backend Engine" },
                        { tech: "PHP", framework: "Laravel Blade", category: "Frontend UI" },
                        { tech: "SQL", database: "MySQL", category: "Relational Storage" }
                    ]
                };
            } else {
                mockResponse = {
                    status: "healthy",
                    code: 200,
                    server: "Python Uvicorn / Gunicorn",
                    timestamp: new Date().toISOString()
                };
            }

            const endTime = performance.now();
            const duration = Math.round(endTime - startTime);

            // Tampilkan hasil sukses
            statusBadge.innerText = "200 OK";
            statusBadge.className = "text-xs font-mono px-2.5 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-bold";
            latencyEl.innerText = `${duration} ms`;
            
            // Format syntax JSON berwarna
            outputEl.innerHTML = `<code class="text-emerald-300">${JSON.stringify(mockResponse, null, 2)}</code>`;

        } catch (error) {
            statusBadge.innerText = "ERROR";
            statusBadge.className = "text-xs font-mono px-2.5 py-0.5 rounded bg-red-500/20 text-red-400 font-bold";
            outputEl.innerHTML = `<code class="text-red-400">// Gagal terhubung ke Python API backend.\n// Pastikan server Python aktif di port yang sesuai.</code>`;
        } finally {
            btnSend.disabled = false;
            btnSend.innerHTML = `<i class="fa-solid fa-play text-xs"></i> Kirim Request ke Python API`;
        }
    }
</script>
@endpush