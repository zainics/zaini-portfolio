
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZAINI.DEV // Vehicle Detection & ANPR</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <script>
        const FASTAPI_BASE_URL = "http://127.0.0.1:8001";
        const WS_ENDPOINT = `${FASTAPI_BASE_URL.replace("http", "ws")}/ws/vehicle-detections`;
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        code,
        pre,
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #020617;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 4px;
        }

        video {
            background: #020617;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<div class="min-h-screen p-4 md:p-8 lg:p-10 space-y-8 max-w-7xl mx-auto flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">

        <div class="flex items-center space-x-3">
            <span class="w-3 h-3 rounded-full bg-cyan-400 animate-pulse"></span>

            <span class="text-sm font-mono text-white font-bold tracking-wider">
                ZAINI.DEV // ANPR MODULE
            </span>
        </div>

        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
            <a href="{{ route('portfolio.api-playground') }}"
               class="text-slate-400 hover:text-cyan-300 transition-colors">
                FastAPI Playground
            </a>

            <a href="{{ route('portfolio.ai-chat') }}"
               class="text-slate-400 hover:text-cyan-300 transition-colors">
                AI Chatbot Booth
            </a>

            <a href="{{ route('portfolio.ocr-scan') }}"
               class="text-slate-400 hover:text-cyan-300 transition-colors">
                OCR Scanner
            </a>

            <a href="{{ route('portfolio.tradingview') }}"
               class="text-slate-400 hover:text-cyan-300 transition-colors">
                External API
            </a>

            <a href="{{ route('vehicle.dashboard') }}"
               class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">
                Vehicle Detection
            </a>
        </div>

        <div>
            <a href="{{ route('portfolio.home') }}"
               class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all">
                Back to Home
            </a>
        </div>

    </nav>


    <!-- HEADER STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-mono text-slate-400 uppercase tracking-wider">
                    Total Unique Vehicles
                </p>

                <h3 id="statTotalVehicles"
                    class="text-2xl font-bold font-mono text-cyan-400 mt-1">
                    0
                </h3>
            </div>

            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 font-mono font-bold">
                🚗
            </div>
        </div>


        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-mono text-slate-400 uppercase tracking-wider">
                    System Status
                </p>

                <h3 class="text-lg font-bold font-mono text-emerald-400 mt-1">
                    GPU CUDA Active
                </h3>
            </div>

            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 font-mono font-bold">
                ⚡
            </div>
        </div>


        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-mono text-slate-400 uppercase tracking-wider">
                    Line Config
                </p>

                <h3 class="text-sm font-bold font-mono text-slate-200 mt-1">
                    Y: 0.75 | X: 0.25
                </h3>
            </div>

            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 font-mono font-bold">
                📍
            </div>
        </div>

    </div>


    <!-- MAIN CONTENT -->
    <main class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">

        <!-- SECTION HEADER -->
        <div class="border-b border-slate-800 pb-3 flex items-center justify-between">

            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>

                <h3 class="text-xs font-mono text-white uppercase tracking-wider font-semibold">
                    Video Source & Processing Control
                </h3>
            </div>

            <span id="feedStatus"
                  class="text-[11px] font-mono text-slate-400">
                Status: Menunggu Video...
            </span>

        </div>


        <!-- VIDEO AND CAPTURE GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


            <!-- LEFT: VIDEO PLAYER -->
            <div class="lg:col-span-8 space-y-5">

                <!-- VIDEO UPLOAD -->
                <div>

                    <label for="videoFile"
                           class="block text-xs font-mono text-slate-400 mb-2 uppercase tracking-wider">
                        Unggah Berkas Video (.mp4)
                    </label>

                    <input
                        type="file"
                        id="videoFile"
                        accept="video/mp4,.mp4"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-xs font-mono file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/20 file:text-cyan-400 hover:file:bg-cyan-500/30 transition-all"
                    >

                </div>


                <!-- VIDEO PLAYER CONTAINER -->
                <div class="relative aspect-video bg-slate-950 border border-slate-800 rounded-xl overflow-hidden flex items-center justify-center shadow-inner">


                    <!-- PROCESSED VIDEO -->
                    <video
                        id="videoPlayer"
                        class="w-full h-full object-contain hidden"
                        controls
                        playsinline
                        preload="metadata">
                    </video>


                    <!-- INITIAL PLACEHOLDER -->
                    <div
                        id="videoPlaceholder"
                        class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-slate-500 font-mono text-xs">

                        <div class="text-4xl mb-4">
                            🎥
                        </div>

                        <p class="text-cyan-400 mb-2">
                            [VIDEO PLAYER READY]
                        </p>

                        <p>
                            Unggah video untuk memulai proses deteksi.
                        </p>

                    </div>


                    <!-- PROCESSING OVERLAY -->
                    <div
                        id="processingOverlay"
                        class="absolute inset-0 hidden bg-slate-950 flex-col items-center justify-center z-20">

                        <div class="w-14 h-14 border-4 border-cyan-500 border-t-transparent rounded-full animate-spin mb-5"></div>

                        <p class="text-cyan-400 font-mono text-sm font-semibold">
                            INITIALIZING AI ENGINE...
                        </p>

                        <p class="text-xs text-slate-400 mt-3 font-mono text-center px-6">
                            Backend sedang memproses video, melakukan deteksi kendaraan,
                            dan menyimpan hasil capture ke database.
                        </p>

                        <p class="text-xs text-slate-500 mt-4 font-mono tracking-widest">
                            PLEASE WAIT
                        </p>

                    </div>

                </div>


                <!-- PROCESS BUTTON -->
                <button
                    type="button"
                    onclick="processVideoDetection()"
                    id="processBtn"
                    class="w-full py-3.5 px-6 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:opacity-90 shadow-lg shadow-cyan-500/20 transition-all disabled:opacity-50 disabled:cursor-not-allowed">

                    Proses Deteksi Kendaraan (FastAPI GPU)

                </button>

            </div>


            <!-- RIGHT: VIDEO-SYNCHRONIZED CAPTURES -->
            <div class="lg:col-span-4 bg-slate-950 border border-slate-800 rounded-xl p-4 flex flex-col h-[590px]">

                <!-- GRID HEADER -->
                <div class="border-b border-slate-800 pb-2 mb-3 flex items-center justify-between">

                    <span class="text-xs font-mono text-slate-300 uppercase tracking-wider font-semibold">
                        Video-Synchronized Captures
                    </span>

                    <span class="text-[10px] font-mono text-cyan-400 bg-cyan-500/10 px-2 py-0.5 rounded border border-cyan-500/20">
                        PLAYBACK SYNC
                    </span>

                </div>


                <!-- CAPTURE GRID -->
                <div
                    id="captureFeedContainer"
                    class="flex-1 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-3 pr-1">

                    <div
                        id="emptyGridState"
                        class="col-span-2 h-full flex items-center justify-center text-center p-6 text-slate-600 font-mono text-xs">

                        [READY] Halaman bersih.
                        Silakan unggah video untuk memulai deteksi.

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>


<!-- PLAYBACK INTEGRATION -->
<script src="{{ asset('js/dashboard_playback_integration.js') }}"></script>

</body>
</html>
