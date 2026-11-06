<header class="sticky top-0 z-50 bg-slate-900/85 backdrop-blur-md border-b border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 via-indigo-500 to-emerald-400 p-[2px] transition duration-300 group-hover:scale-105">
                <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center">
                    <i class="fa-solid fa-code text-cyan-400"></i>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-lg tracking-wider bg-gradient-to-r from-white via-slate-200 to-cyan-400 bg-clip-text text-transparent">
                    ZAINI<span class="text-cyan-400">.</span>DOANK
                </span>
                <span class="text-[10px] text-slate-400 font-mono tracking-widest uppercase">IT ENGINEER</span>
            </div>
        </a>

        <!-- Menu Navigation (Bersih tanpa teks sisa) -->
        <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-300">
            <a href="#hero" class="hover:text-cyan-400 transition-colors">Home</a>
            <a href="#biodata" class="hover:text-cyan-400 transition-colors">Biodata</a>
            <a href="#managed-services" class="hover:text-cyan-400 transition-colors">Managed Services</a>
            <a href="#architecture" class="hover:text-cyan-400 transition-colors">Arsitektur</a>
            <a href="#contact" class="hover:text-cyan-400 transition-colors">Kontak</a>
        </nav>

        <!-- CTA Action (Tombol Test Live API) -->
        <div class="flex items-center gap-4">
            <a href="{{ route('portfolio.api-playground') }}" class="px-4 py-2.5 rounded-xl text-xs font-mono font-semibold bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-lg shadow-cyan-500/20 hover:opacity-90 transition-all flex items-center space-x-2">
                <i class="fa-solid fa-bolt text-cyan-200"></i>
                <span>Test Live API</span>
            </a>
        </div>
    </div>
</header>