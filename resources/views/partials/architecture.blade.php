<section id="architecture" class="py-20 bg-slate-900/40 border-t border-slate-800/80 relative overflow-hidden">
    <!-- Ambient Glow Background -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-indigo-500/10 blur-[130px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-mono font-semibold tracking-widest text-indigo-400 uppercase bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">
                System Design & Architecture
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4">
                Integrasi Laravel, Python & MySQL
            </h2>
            <p class="text-slate-400 mt-3 text-base">
                Diagram alur komunikasi end-to-end yang memisahkan lapisan antarmuka pengguna (Frontend), pemrosesan logika & AI (Backend Python), serta penyimpanan data relasional.
            </p>
        </div>

        <!-- Diagram & Flow Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-12">
            
            <!-- Layer 1: Frontend Laravel -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl flex flex-col justify-between relative group hover:border-red-500/50 transition-all">
                <div class="absolute top-4 right-4 text-xs font-mono text-red-400 bg-red-500/10 px-2.5 py-1 rounded-full border border-red-500/20">
                    Client Tier
                </div>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mb-6 text-red-500 text-2xl">
                        <i class="fa-brands fa-laravel"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">1. Laravel Frontend</h3>
                    <p class="text-xs font-mono text-cyan-400 mb-4">Blade Template + Tailwind CSS + Guzzle / Axios</p>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Bertindak sebagai tampilan antarmuka web (UI/UX), mengatur routing halaman portofolio, serta mengirimkan HTTP request asinkron (AJAX/Fetch) ke server Python untuk memuat data secara dinamis.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800/80 text-xs font-mono text-slate-400">
                    <i class="fa-solid fa-check text-emerald-400 mr-1"></i> Render View & UI Interaction
                </div>
            </div>

            <!-- Layer 2: Backend Python -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl flex flex-col justify-between relative group hover:border-cyan-500/50 transition-all">
                <div class="absolute top-4 right-4 text-xs font-mono text-cyan-400 bg-cyan-500/10 px-2.5 py-1 rounded-full border border-cyan-500/20">
                    Service Tier
                </div>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-6 text-cyan-400 text-2xl">
                        <i class="fa-brands fa-python"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">2. Python Backend API</h3>
                    <p class="text-xs font-mono text-cyan-400 mb-4">FastAPI / Flask + SQLAlchemy / PyMySQL</p>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Pusat pemrosesan logika bisnis, RESTful API endpoints, serta integrasi modul kecerdasan buatan (AI/Trading Bot) yang menerima permintaan dari Laravel dan memproses data sebelum dikirim kembali.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800/80 text-xs font-mono text-slate-400">
                    <i class="fa-solid fa-check text-emerald-400 mr-1"></i> REST API & Business Logic
                </div>
            </div>

            <!-- Layer 3: Database MySQL -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl flex flex-col justify-between relative group hover:border-amber-500/50 transition-all">
                <div class="absolute top-4 right-4 text-xs font-mono text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-500/20">
                    Data Tier
                </div>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mb-6 text-amber-500 text-2xl">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">3. MySQL Database</h3>
                    <p class="text-xs font-mono text-amber-400 mb-4">Relational Storage & Indexing</p>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Menyimpan seluruh data terstruktur seperti profil biodata, riwayat karier, daftar proyek, log transaksi, hingga konfigurasi sistem dengan keandalan query relasional yang optimal.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800/80 text-xs font-mono text-slate-400">
                    <i class="fa-solid fa-check text-emerald-400 mr-1"></i> Relational Data Persistence
                </div>
            </div>

        </div>

        <!-- Alur Komunikasi / Data Flow Box -->
        <div class="bg-slate-950 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl font-mono">
            <h4 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-4 flex items-center gap-2">
                <i class="fa-solid fa-code-branch text-indigo-400"></i> Alur Komunikasi Data (Data Flow Cycle)
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-400">
                <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                    <span class="text-red-400 font-bold block mb-1">Step 1: Client Request</span>
                    Pengunjung membuka halaman web di browser. Laravel merender view Blade dan halaman melakukan AJAX fetch saat tombol API Tester ditekan.
                </div>
                <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                    <span class="text-cyan-400 font-bold block mb-1">Step 2: API Processing</span>
                    Python backend menerima request melalui HTTP endpoint, memvalidasi parameter, dan melakukan query ke database MySQL menggunakan ORM.
                </div>
                <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                    <span class="text-amber-400 font-bold block mb-1">Step 3: JSON Response</span>
                    MySQL mengembalikan data, Python memformatnya menjadi objek JSON terstruktur, lalu dikembalikan ke frontend Laravel untuk ditampilkan di konsol.
                </div>
            </div>
        </div>

    </div>
</section>