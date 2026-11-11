<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // TradingView Market XAUUSD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<div class="min-h-screen p-4 md:p-8 lg:p-10 space-y-8 max-w-7xl mx-auto flex flex-col">
    
    <!-- Navbar Utama -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <span class="text-sm font-mono text-white font-bold tracking-wider">ZAINI.DEV // External API Integration</span>
        </div>

        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
            <a href="{{ route('portfolio.api-playground') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">FastAPI Playground</a>
            <a href="{{ route('portfolio.ai-chat') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">AI Chatbot Booth</a>
            <a href="{{ route('portfolio.ocr-scan') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">OCR Scanner</a>
            <a href="{{ route('portfolio.tradingview') }}" class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">External API</a>
        </div>

        <div>
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all">Back to Home</a>
        </div>
    </nav>

    <!-- Kontainer TradingView Widget -->
    <section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl flex flex-col space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
            <div class="flex items-center space-x-3">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                <h3 class="text-sm font-mono text-slate-200 font-semibold tracking-wide">
                    📈 Live Market Gold (XAUUSD) - Advanced Chart (TradingView)
                </h3>
            </div>
            <span class="text-[11px] font-mono text-cyan-400 bg-slate-800 px-3 py-1 rounded-full border border-slate-700">
                OANDA:XAUUSD | Widget v3.0
            </span>
        </div>

        <!-- Kontainer Widget dengan Tinggi 850px Mutlak -->
        <div class="tradingview-widget-container rounded-xl overflow-hidden border border-slate-800" style="height: 650px;">
            <div class="tradingview-widget-container__widget" style="height: 100%; width: 100%;"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
            {
                "autosize": false,
                "width": "100%",
                "height": "600",
                "symbol": "OANDA:XAUUSD",
                "interval": "D",
                "timezone": "Asia/Jakarta",
                "theme": "dark",
                "style": "1",
                "locale": "id",
                "enable_publishing": false,
                "hide_side_toolbar": false,
                "allow_symbol_change": true,
                "calendar": false,
                "support_host": "https://www.tradingview.com"
            }
            </script>
        </div>
    </section>

</div>

</body>
</html>