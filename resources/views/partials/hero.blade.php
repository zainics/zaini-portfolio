<section id="hero" class="relative min-h-[calc(100vh-5rem)] flex items-center justify-center py-16 overflow-hidden">
    <!-- Ambient Background Glow -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-cyan-500/10 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-10 left-1/3 w-[400px] h-[250px] bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Left Content Column -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Live System Badges -->
            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Python API Online
                </span>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                    <i class="fa-brands fa-laravel text-red-500"></i> Laravel Frontend
                </span>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono bg-amber-500/10 text-amber-400 border border-amber-500/20">
                    <i class="fa-solid fa-database text-amber-400"></i> MySQL Connected
                </span>
            </div>

            <!-- Headline -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                IT Management & <br>
                <span class="bg-gradient-to-r from-cyan-400 via-indigo-300 to-emerald-400 bg-clip-text text-transparent">
                    Software Development
                </span>
            </h1>

            <p class="text-slate-400 text-base sm:text-lg leading-relaxed max-w-2xl">
                Menghubungkan keandalan infrastruktur IT, manajemen proyek strategis, dan managed services dengan performa tinggi pengembangan perangkat lunak berbasis Laravel, Python API, dan MySQL.
            </p>

            <!-- Tech & Management Badges Bar -->
            <div class="flex flex-wrap items-center gap-6 pt-2 text-slate-400">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-diagram-project text-xl text-cyan-400"></i>
                    <span class="text-sm font-semibold text-slate-200">IT Management</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-brands fa-python text-2xl text-cyan-400"></i>
                    <span class="text-sm font-semibold text-slate-200">Python API</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-brands fa-laravel text-2xl text-red-500"></i>
                    <span class="text-sm font-semibold text-slate-200">Laravel UI</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-server text-xl text-amber-500"></i>
                    <span class="text-sm font-semibold text-slate-200">Infrastructure</span>
                </div>
            </div>



            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-4 pt-2">
                <a href="{{ route('portfolio.api-playground') }}" class="px-6 py-3 rounded-xl font-semibold bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-xl shadow-cyan-500/25 hover:shadow-cyan-500/40 hover:-translate-y-0.5 transition-all">
                    <i class="fa-solid fa-terminal mr-2"></i>Uji Live API
                </a>
                <a href="#biodata" class="px-6 py-3 rounded-xl font-semibold bg-slate-900 text-slate-300 border border-slate-800 hover:bg-slate-800 hover:text-white transition-all">
                    Lihat Portofolio & CV
                </a>
            </div>

            <!-- Stats Counter Bar -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-6 border-t border-slate-800/80 mt-6">
                <div>
                    <h4 class="text-2xl sm:text-3xl font-extrabold text-cyan-400">15+</h4>
                    <p class="text-xs text-slate-400 font-mono mt-1">Years Experience</p>
                </div>
                <div>
                    <h4 class="text-2xl sm:text-3xl font-extrabold text-cyan-400">20+</h4>
                    <p class="text-xs text-slate-400 font-mono mt-1">Major Projects</p>
                </div>
                <div>
                    <h4 class="text-2xl sm:text-3xl font-extrabold text-cyan-400">5+</h4>
                    <p class="text-xs text-slate-400 font-mono mt-1">Industries</p>
                </div>
                <div>
                    <h4 class="text-2xl sm:text-3xl font-extrabold text-cyan-400">50+</h4>
                    <p class="text-xs text-slate-400 font-mono mt-1">Systems Delivered</p>
                </div>
            </div>

        </div>

        <!-- Right Visual / Profile Column (Diperbesar & Disesuaikan Ulang Layoutnya) -->
        <div class="lg:col-span-5 flex justify-center relative">
            <div class="relative w-full max-w-md">
                
                <!-- Glowing Profile Frame -->
                <div class="relative rounded-3xl p-1 bg-gradient-to-b from-cyan-500 via-indigo-500 to-emerald-500 shadow-2xl shadow-cyan-500/20">
                    <div class="bg-slate-900 rounded-[22px] p-6 text-center overflow-hidden">
                        
                        <!-- Foto Profile Diperbesar (w-56 h-56 atau ukuran lebih lebar) -->
                        <div class="w-full h-72 mx-auto rounded-2xl bg-slate-800 border-2 border-slate-700 overflow-hidden mb-5 shadow-inner">
                            <img src="{{ asset('images/profile.jpg') }}" alt="Zaini" class="w-full h-full object-cover object-top" onError="this.src='https://via.placeholder.com/400?text=Zaini'">
                        </div>

                        <h3 class="text-2xl font-bold text-white">Zaini</h3>
                        <p class="text-xs text-cyan-400 font-mono mt-1">IT Management & Software Developer</p>

                        <!-- Quick Live Ping Teaser Widget -->
                        <div class="mt-6 p-4 rounded-xl bg-slate-950/80 border border-slate-800/80 text-left">
                            <div class="flex items-center justify-between text-xs mb-2">
                                <span class="font-mono text-slate-400"><i class="fa-solid fa-network-wired text-cyan-400 mr-1"></i> System Status</span>
                                <span class="text-emerald-400 font-bold" id="ping-status">ONLINE</span>
                            </div>
                            <div class="bg-slate-900 p-2.5 rounded-lg text-xs font-mono text-slate-300 flex justify-between items-center">
                                <span>GET /api/v1/health</span>
                                <button onclick="checkApiHealth()" class="px-2.5 py-1 rounded bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 hover:bg-cyan-500/30 transition-all text-[11px]">
                                    Test Ping
                                </button>
                            </div>
                            <div id="ping-result" class="mt-2 text-[11px] font-mono text-slate-400 hidden">
                                Response: <span class="text-emerald-400" id="ping-time">-- ms</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    async function checkApiHealth() {
        const statusEl = document.getElementById('ping-status');
        const resultEl = document.getElementById('ping-result');
        const timeEl = document.getElementById('ping-time');

        statusEl.innerText = "PINGING...";
        statusEl.className = "text-amber-400 font-bold";

        const start = performance.now();
        try {
            await new Promise(resolve => setTimeout(resolve, 250)); 
            const duration = Math.round(performance.now() - start);

            statusEl.innerText = "200 OK";
            statusEl.className = "text-emerald-400 font-bold";
            resultEl.classList.remove('hidden');
            timeEl.innerText = `${duration} ms`;
        } catch (error) {
            statusEl.innerText = "ERROR";
            statusEl.className = "text-red-400 font-bold";
        }
    }
</script>
@endpush