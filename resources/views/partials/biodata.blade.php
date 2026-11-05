<section id="biodata" class="py-20 bg-slate-900/50 border-t border-slate-800/80 relative overflow-hidden">
    <!-- Ambient Blur Background -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-cyan-500/10 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-mono font-semibold tracking-widest text-cyan-400 uppercase bg-cyan-500/10 px-3 py-1 rounded-full border border-cyan-500/20">
                Profil & Curriculum Vitae
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4">
                Zaini — IT Project Manager & Fullstack Developer
            </h2>
            <p class="text-slate-400 mt-3 text-base">
                Berpengalaman lebih dari 15 tahun di bidang Infrastruktur IT, Manajemen Proyek, Sistem Perbankan, hingga pengembangan kecerdasan buatan (AI) berbasis Python dan database MySQL.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Sidebar / Card Ringkasan Biodata -->
            <div class="lg:col-span-4 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
                <div class="flex items-center gap-4 pb-6 border-b border-slate-800">
                    <div class="w-16 h-16 rounded-xl bg-slate-800 border border-slate-700 overflow-hidden shrink-0">
                        <!-- Menggunakan foto dari assets atau fallback -->
                        <img src="{{ asset('images/profile.jpg') }}" alt="Zaini" class="w-full h-full object-cover" onError="this.src='https://via.placeholder.com/150?text=Zaini'">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Zaini</h3>
                        <p class="text-xs text-cyan-400 font-mono">IT Engineer</p>
                        <div class="flex items-center gap-2 mt-2 text-xs text-slate-400">
                            <i class="fa-solid fa-location-dot text-emerald-400"></i> Cinere, Depok
                        </div>
                    </div>
                </div>

                <!-- Detail Informasi Personal (Sesuai CV) -->
                <div class="space-y-3 text-xs font-mono">
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">TTL</span>
                        <span class="text-slate-200">Jakarta, 17 Feb 1986</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Status</span>
                        <span class="text-emerald-400 font-semibold">Menikah</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Pendidikan</span>
                        <span class="text-cyan-400 font-semibold">Diploma IT (BSI 2007)</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Email</span>
                        <span class="text-slate-200 truncate max-w-[180px]">zaini.cs@gmail.com</span>
                    </div>
                </div>

                <!-- Keahlian Utama (Tags) -->
                <div>
                    <h4 class="text-xs font-mono text-slate-400 uppercase tracking-wider mb-3">Keahlian Utama</h4>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="text-[11px] font-mono bg-cyan-500/10 text-cyan-300 px-2 py-1 rounded border border-cyan-500/20">Python</span>
                        <span class="text-[11px] font-mono bg-red-500/10 text-red-300 px-2 py-1 rounded border border-red-500/20">PHP / Laravel</span>
                        <span class="text-[11px] font-mono bg-amber-500/10 text-amber-300 px-2 py-1 rounded border border-amber-500/20">MySQL / SQLServer</span>
                        <span class="text-[11px] font-mono bg-indigo-500/10 text-indigo-300 px-2 py-1 rounded border border-indigo-500/20">Project Management</span>
                        <span class="text-[11px] font-mono bg-emerald-500/10 text-emerald-300 px-2 py-1 rounded border border-emerald-500/20">Network Infra</span>
                    </div>
                </div>

                <!-- Tombol Download CV -->
                <div>
                    <a href="{{ asset('files/ZDoank_CV.pdf') }}" download="CV_Zaini_IT_Engineer.pdf" class="w-full py-3 px-4 rounded-xl bg-slate-800 border border-slate-700 hover:border-cyan-500/50 hover:bg-slate-800/80 text-white font-semibold flex items-center justify-center gap-2 text-sm transition-all shadow-md">
                        <i class="fa-solid fa-download text-cyan-400"></i> Download Resume (PDF)
                    </a>
                </div>

            </div>

            <!-- Tab Konten: Riwayat Karier & Proyek -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Card Riwayat Karier (Work Experience) -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-cyan-400"></i> Riwayat Karier
                    </h3>

                    <div class="relative border-l-2 border-slate-800 ml-3 space-y-8 pl-6">
                        
                        <!-- Item 1 -->
                        <div class="relative group">
                            <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-cyan-500 border-4 border-slate-900 group-hover:scale-125 transition-transform"></div>
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="font-bold text-white text-base">IT Project Manager</h4>
                                <span class="text-xs font-mono text-cyan-400 bg-slate-800 px-2.5 py-1 rounded-full">Feb 2020 - Des 2024</span>
                            </div>
                            <p class="text-xs text-slate-400 font-mono mt-1">PT. Caraka Mandiri Solusi (IT Solutions)</p>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Melakukan perencanaan proyek, menghitung anggaran (budgeting), dan memimpin tim lapangan untuk implementasi solusi IT.
                            </p>
                        </div>

                        <!-- Item 2 -->
                        <div class="relative group">
                            <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-900 group-hover:scale-125 transition-transform"></div>
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="font-bold text-white text-base">IT Project Manager</h4>
                                <span class="text-xs font-mono text-slate-400 bg-slate-800 px-2.5 py-1 rounded-full">Apr 2017 - Jun 2019</span>
                            </div>
                            <p class="text-xs text-slate-400 font-mono mt-1">PT. Andalan Terampil Multisiss (Banking IT Solution Provider)</p>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Mengembangkan <em>Self Service Passbook Printer (SSPP)</em> untuk Bank Besar (BCA, Mandiri, BSI, BJB) serta pengembangan teknologi Payment System untuk Koperasi dan BPR.
                            </p>
                        </div>

                        <!-- Item 3 -->
                        <div class="relative group">
                            <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-900 group-hover:scale-125 transition-transform"></div>
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="font-bold text-white text-base">Head of Information Technology</h4>
                                <span class="text-xs font-mono text-slate-400 bg-slate-800 px-2.5 py-1 rounded-full">Jul 2014 - Jul 2015</span>
                            </div>
                            <p class="text-xs text-slate-400 font-mono mt-1">PT. Kasadasa Perkasa (Oil & Gas Services)</p>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Mengelola Sistem Informasi perusahaan drilling services, pengembangan infrastruktur IT multi-site, serta sistem multi-warehouse untuk efisiensi pengiriman aset dan sparepart.
                            </p>
                        </div>

                        <!-- Item 4 -->
                        <div class="relative group">
                            <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-900 group-hover:scale-125 transition-transform"></div>
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="font-bold text-white text-base">RnD System Asset & Logistics</h4>
                                <span class="text-xs font-mono text-slate-400 bg-slate-800 px-2.5 py-1 rounded-full">Feb 2012 - Jul 2014</span>
                            </div>
                            <p class="text-xs text-slate-400 font-mono mt-1">PT. Duta Adikarya Negeri / PT. Asia Petrocom Services</p>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Mengembangkan Sistem Informasi Asset & Warehouse nasional, perancangan SOP pengiriman barang, serta efisiensi logistik bersama vendor.
                            </p>
                        </div>

                        <!-- Item 5 -->
                        <div class="relative group">
                            <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-slate-600 border-4 border-slate-900 group-hover:scale-125 transition-transform"></div>
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="font-bold text-white text-base">Senior Technical Support Engineer</h4>
                                <span class="text-xs font-mono text-slate-400 bg-slate-800 px-2.5 py-1 rounded-full">Jan 2008 - Nov 2011</span>
                            </div>
                            <p class="text-xs text-slate-400 font-mono mt-1">PT. Rentris Pentabenua - HIT Corporation</p>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Implementasi Product Security System (Fingerprint, Access Control, IP Camera) dan infrastruktur jaringan IT.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Card Proyek Unggulan (Personal & Professional Projects) -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-code text-indigo-400"></i> Personal & Integration Projects Highlight
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="bg-slate-950/80 border border-slate-800 p-4 rounded-xl">
                            <span class="text-[10px] font-mono bg-cyan-500/10 text-cyan-400 px-2 py-0.5 rounded">Python & AI</span>
                            <h4 class="font-bold text-white text-sm mt-2">AI Forex Trading Platform</h4>
                            <p class="text-xs text-slate-400 mt-1">Pengembangan platform AI untuk Forex Trading menggunakan Python & otomatisasi MetaTrader 4-5 (2025-2026).</p>
                        </div>

                        <div class="bg-slate-950/80 border border-slate-800 p-4 rounded-xl">
                            <span class="text-[10px] font-mono bg-amber-500/10 text-amber-400 px-2 py-0.5 rounded">Software & IoT</span>
                            <h4 class="font-bold text-white text-sm mt-2">Automation Parking System</h4>
                            <p class="text-xs text-slate-400 mt-1">Sistem parkir otomatis menggunakan E-Money Reader & QRIS Dynamic (2022-2023).</p>
                        </div>

                        <div class="bg-slate-950/80 border border-slate-800 p-4 rounded-xl">
                            <span class="text-[10px] font-mono bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded">Banking Integration</span>
                            <h4 class="font-bold text-white text-sm mt-2">BPR & Cooperatives Mobile Banking</h4>
                            <p class="text-xs text-slate-400 mt-1">Integrasi layanan Mobile Banking BPR dan Koperasi serta integrasi EDC GPN di BSI (2018-2021).</p>
                        </div>

                        <div class="bg-slate-950/80 border border-slate-800 p-4 rounded-xl">
                            <span class="text-[10px] font-mono bg-indigo-500/10 text-indigo-400 px-2 py-0.5 rounded">Infrastructure</span>
                            <h4 class="font-bold text-white text-sm mt-2">Command Center Korpolairud</h4>
                            <p class="text-xs text-slate-400 mt-1">Pembangunan infrastruktur fiber optik, kelistrikan, sistem keamanan, dan server Command Center Korpolairud (2021-2022).</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</section>