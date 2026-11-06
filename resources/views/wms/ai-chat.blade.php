<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // AI-WMS Chat Assistant Booth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-white">

<!-- Wrapper utama disamakan menggunakan max-w-7xl mx-auto dan space-y-8 seperti api-playground -->
<div class="min-h-screen p-4 md:p-8 lg:p-10 space-y-8 max-w-7xl mx-auto flex flex-col">
    
    <!-- NAVBAR UTAMA (Lebar Konsisten max-w-7xl) -->
    <nav class="bg-slate-900/80 border border-slate-800/80 rounded-2xl px-6 py-4 backdrop-blur-xl shadow-xl flex items-center justify-between">
        <div class="flex items-center space-x-3">
           
            <span class="text-sm font-mono text-white font-bold tracking-wider">ZAINI.DEV // Test Live API</span>
        </div>
        <div class="hidden md:flex items-center space-x-6 text-xs font-mono">
          
            <a href="{{ url('/api-playground') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">FastAPI Playground</a>
            <a href="{{ url('/ai-chat') }}" class="text-cyan-400 font-medium hover:text-cyan-300 transition-colors">AI Chatbot Booth</a>
            <a href="{{ route('portfolio.ocr-scan') }}" class="text-slate-400 hover:text-cyan-300 transition-colors">OCR Scanner</a>
        </div>
        <div>
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all">Back to Home</a>
        </div>
    </nav>

    <!-- CONTAINER CHAT BOOTH (Lebar menyesuaikan max-w-7xl secara penuh) -->
    <section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl flex flex-col h-[75vh]">
        <!-- Header Chat -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <div class="flex items-center space-x-3">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                <h3 class="text-sm font-mono text-slate-200 font-semibold tracking-wide">
                    🤖 ZAINI.DEV // WMS AI Assistant Booth (Dedicated Page)
                </h3>
            </div>
            <span class="text-[11px] font-mono text-cyan-400 bg-slate-800 px-3 py-1 rounded-full border border-slate-700">
                Connected to FastAPI & MySQL
            </span>
        </div>

        <!-- Area Percakapan -->
        <div id="chatMessages" class="flex-1 overflow-y-auto py-4 space-y-4 pr-2">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 rounded-lg bg-cyan-500/15 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono text-xs">AI</div>
                <div class="bg-slate-950 border border-slate-800 rounded-xl p-3.5 max-w-[80%] text-xs text-slate-300 font-sans leading-relaxed">
                    Halo! Silakan ajukan pertanyaan seputar WMS, contoh: <em>"Sebutkan nama barang yang ada"</em> atau <em>"Ada berapa jumlah warehouse?"</em>.
                </div>
            </div>
        </div>

        <!-- Input Form & Tombol Kirim -->
        <div class="pt-4 border-t border-slate-800 flex items-center gap-3">
            <input type="text" id="chatInputPrompt" placeholder="Tanyakan sesuatu ke AI-WMS..." 
                class="flex-1 bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-3 font-sans focus:outline-none focus:border-cyan-500"
                onkeypress="if(event.key === 'Enter') sendChatBoothQuery()">
            
            <button onclick="sendChatBoothQuery()" id="chatSendBtn" class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-mono font-medium hover:opacity-90 shadow-lg shadow-cyan-500/20">
                Kirim Pertanyaan
            </button>
        </div>
    </section>

</div>

<!-- Skrip AI Chatbot -->
<script>
    async function sendChatBoothQuery() {
        const inputField = document.getElementById('chatInputPrompt');
        const chatMessages = document.getElementById('chatMessages');
        const sendBtn = document.getElementById('chatSendBtn');
        
        const userText = inputField.value.trim();
        if (!userText) return;

        appendMessage(userText, 'user');
        inputField.value = '';
        sendBtn.disabled = true;
        sendBtn.innerText = "Berpikir...";

        const loadingId = 'loading-' + Date.now();
        appendLoadingMessage(loadingId);

        try {
            const response = await fetch('http://127.0.0.1:8001/api/v1/ai-wms/llm-assistant', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ warehouse_id: null, prompt_query: userText })
            });

            if (!response.ok) throw new Error(`Gagal terhubung ke server FastAPI (Status: ${response.status})`);

            const data = await response.json();
            document.getElementById(loadingId).remove();
            appendMessage(data.llm_insight, 'ai', data.database_context);

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
                <div class="bg-cyan-500/15 border border-cyan-500/30 rounded-xl p-3.5 max-w-[80%] text-xs text-cyan-200 font-sans leading-relaxed">${escapeHtml(text)}</div>
                <div class="w-8 h-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-300 font-mono text-xs">Anda</div>
            `;
        } else if (sender === 'ai') {
            let contextHtml = context ? `
                <div class="mt-2 pt-2 border-t border-slate-800 text-[10px] font-mono text-slate-400 flex gap-3">
                    <span>SKU Types: <strong class="text-cyan-400">${context.total_sku_types}</strong></span>
                    <span>Total Units: <strong class="text-blue-400">${context.total_stock_units}</strong></span>
                    <span>Kritis: <strong class="text-rose-400">${context.critical_items_count}</strong></span>
                </div>` : '';
            item.className = "flex items-start space-x-3";
            item.innerHTML = `
                <div class="w-8 h-8 rounded-lg bg-cyan-500/15 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono text-xs">AI</div>
                <div class="bg-slate-950 border border-slate-800 rounded-xl p-3.5 max-w-[80%] text-xs text-slate-300 font-sans leading-relaxed">${text}${contextHtml}</div>
            `;
        } else {
            item.className = "flex items-start space-x-3";
            item.innerHTML = `
                <div class="w-8 h-8 rounded-lg bg-rose-500/15 border border-rose-500/30 flex items-center justify-center text-rose-400 font-mono text-xs">!</div>
                <div class="bg-rose-950/40 border border-rose-900/50 rounded-xl p-3.5 max-w-[80%] text-xs text-rose-300 font-sans leading-relaxed">${text}</div>
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