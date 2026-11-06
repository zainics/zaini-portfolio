<section id="contact" class="py-20 bg-slate-950 border-t border-slate-800/80 relative overflow-hidden">
    <!-- Ambient Blur Background -->
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-500/10 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-mono font-semibold tracking-widest text-cyan-400 uppercase bg-cyan-500/10 px-3 py-1 rounded-full border border-cyan-500/20">
                Get In Touch
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4">
                Hubungi & Diskusi Proyek
            </h2>
            <p class="text-slate-400 mt-3 text-base">
                Apakah Anda memiliki proyek, kebutuhan integrasi sistem perbankan/AI, atau peluang kerja sama? Silakan kirimkan pesan di bawah ini.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Direct Contact Info & Socials -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl space-y-6">
                    <h3 class="text-xl font-bold text-white mb-2">Informasi Kontak Direct</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Terbuka untuk konsultasi arsitektur IT, integrasi REST API Python, pengembangan sistem Laravel, dan proyek infrastruktur.
                    </p>

                    <div class="space-y-4 pt-2">
                        <!-- Email Card -->
                        <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-950/80 border border-slate-800/80">
                            <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shrink-0">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="overflow-hidden">
                                <span class="text-[10px] font-mono text-slate-400 uppercase block">Email Utama</span>
                                <a href="mailto:zaini.cs@gmail.com" class="text-sm font-semibold text-white hover:text-cyan-400 transition-colors truncate block">zaini.cs@gmail.com</a>
                            </div>
                        </div>

                        <!-- Location Card -->
                        <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-950/80 border border-slate-800/80">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-mono text-slate-400 uppercase block">Lokasi & Domisili</span>
                                <span class="text-sm font-semibold text-white block">Cinere, Depok — Indonesia</span>
                            </div>
                        </div>

                        <!-- Specialization Card -->
                        <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-950/80 border border-slate-800/80">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 shrink-0">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-mono text-slate-400 uppercase block">Spesialisasi Role</span>
                                <span class="text-sm font-semibold text-white block">IT Project Manager & Fullstack Dev</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social / Professional Links -->
                    <div class="pt-4 border-t border-slate-800/80">
                        <span class="text-xs font-mono text-slate-400 block mb-3">Tautan Profesional & Repository</span>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                                <i class="fa-brands fa-linkedin-in text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                                <i class="fa-solid fa-file-pdf text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Interactive Contact Form -->
            <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-cyan-400"></i> Kirim Pesan Pesan Langsung
                </h3>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Email</label>
                        <input type="email" name="email" required class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:outline-none">
                    </div>
                    <div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Subjek</label>
                        <input type="text" name="subject" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:outline-none" placeholder="Subjek pesan (opsional)">
                    </div>

                        <label class="block text-xs font-mono text-slate-400 mb-1">Pesan</label>
                        <textarea name="message" rows="4" required class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-cyan-500 focus:outline-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-semibold shadow-lg shadow-cyan-500/20 hover:opacity-90 transition-all">
                         <i class="fa-solid fa-paper-plane text-xs"></i> Kirim Pesan via API
                    </button>

                </form>
            </div>

        </div>

    </div>
</section>

<!-- Footer Section -->
<footer class="bg-slate-950 border-t border-slate-800/80 py-12 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-8 border-b border-slate-900">
            
            <!-- Brand Info -->
            <a href="#hero" class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-cyan-500 via-indigo-500 to-emerald-400 p-[1.5px]">
                    <div class="w-full h-full bg-slate-950 rounded-[6px] flex items-center justify-center">
                        <i class="fa-solid fa-code text-cyan-400 text-xs"></i>
                    </div>
                </div>
                <span class="font-bold text-base tracking-wider text-white">
                    ZAINI<span class="text-cyan-400">.</span>DOANKs
                </span>
            </a>

            <!-- Quick Links -->
            <nav class="flex flex-wrap items-center justify-center gap-6 text-xs font-medium text-slate-400">
                <a href="#hero" class="hover:text-cyan-400 transition-colors">Home</a>
                <a href="#biodata" class="hover:text-cyan-400 transition-colors">Biodata & CV</a>
                <a href="#api-tester" class="hover:text-cyan-400 transition-colors">API Tester</a>
                <a href="#architecture" class="hover:text-cyan-400 transition-colors">Arsitektur</a>
                <a href="#contact" class="hover:text-cyan-400 transition-colors">Kontak</a>
            </nav>

            <!-- Status Indicator -->
            <div class="flex items-center gap-2 text-xs font-mono text-slate-400">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Laravel v11 + Python API</span>
            </div>

        </div>

        <!-- Copyright Notice -->
        <div class="pt-8 text-center text-xs text-slate-500 font-mono">
            &copy; {{ date('Y') }} Zaini. All rights reserved. Built with Laravel Blade, Tailwind CSS, Python (FastAPI/Flask) & MySQL.
        </div>

    </div>
</footer>

@push('scripts')
<script>
    async function handleContactSubmit(e) {
        e.preventDefault();
        
        const btn = document.getElementById('btn-submit-contact');
        const alertEl = document.getElementById('form-alert');
        
        btn.disabled = true;
        btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin mr-2"></i> Mengirim...`;
        
        // Simulasi pengiriman data formulir
        setTimeout(() => {
            alertEl.classList.remove('hidden', 'bg-red-500/10', 'text-red-400', 'border-red-500/20');
            alertEl.classList.add('bg-emerald-500/10', 'text-emerald-400', 'border', 'border-emerald-500/20');
            alertEl.innerHTML = `<i class="fa-solid fa-circle-check mr-2"></i> Pesan Anda telah berhasil terkirim! Terima kasih telah menghubungi.`;
            
            document.getElementById('contact-form').reset();
            btn.disabled = false;
            btn.innerHTML = `<i class="fa-solid fa-paper-plane text-xs"></i> Kirim Pesan via API`;
        }, 1000);
    }
</script>
@endpush