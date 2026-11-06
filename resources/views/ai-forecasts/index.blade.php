<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAINI.DEV // AI Demand Forecasts Logs</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased min-h-screen p-6 md:p-10">

<div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Header Navigasi -->
    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
        <div class="flex items-center space-x-3">
            <a href="/portfolio" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs font-mono text-cyan-400 hover:border-cyan-500 transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Dashboard Portfolio</span>
            </a>
            <span class="text-slate-700">/</span>
            <h1 class="text-xs md:text-sm font-mono text-slate-300 font-semibold tracking-wide">AI-WMS // PyTorch Inference Audit Logs</h1>
        </div>
        <span class="text-xs font-mono px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">Table: ai_demand_forecasts</span>
    </div>

    <!-- Tabel Riwayat Data -->
    <div class="bg-slate-900/50 border border-slate-800/80 rounded-2xl overflow-hidden backdrop-blur-xl shadow-2xl">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <h3 class="text-sm font-mono font-semibold text-white uppercase tracking-wider">Riwayat Prediksi Permintaan (Time-Series)</h3>
            <span class="text-xs font-mono text-slate-400">Total Data: {{ $forecasts->total() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs font-mono">
                <thead>
                    <tr class="bg-slate-950 text-slate-400 uppercase tracking-wider border-b border-slate-800">
                        <th class="py-3.5 px-4">ID</th>
                        <th class="py-3.5 px-4">Warehouse</th>
                        <th class="py-3.5 px-4">Produk (SKU)</th>
                        <th class="py-3.5 px-4">Target Tanggal</th>
                        <th class="py-3.5 px-4 text-right">Prediksi Demand</th>
                        <th class="py-3.5 px-4 text-center">Confidence</th>
                        <th class="py-3.5 px-4">Model Version</th>
                        <th class="py-3.5 px-4">Waktu Eksekusi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($forecasts as $item)
                        <tr class="hover:bg-slate-850/50 transition-colors">
                            <td class="py-3.5 px-4 text-slate-500">#{{ $item->id }}</td>
                            <td class="py-3.5 px-4 font-semibold text-cyan-400">{{ $item->warehouse_code }}</td>
                            <td class="py-3.5 px-4 font-medium text-white">{{ $item->product_name }}</td>
                            <td class="py-3.5 px-4 text-slate-300">{{ $item->forecast_date }}</td>
                            <td class="py-3.5 px-4 text-right font-bold text-emerald-400">{{ number_format($item->predicted_demand, 2) }} Unit</td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="px-2 py-0.5 rounded text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    {{ number_format($item->confidence_score * 100, 1) }}%
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-400">{{ $item->model_version }}</td>
                            <td class="py-3.5 px-4 text-slate-500 text-[11px]">{{ $item->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-slate-500 italic">
                                Belum ada riwayat inferensi PyTorch yang tersimpan di database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        @if($forecasts->hasPages())
            <div class="p-4 bg-slate-950 border-t border-slate-800">
                {{ $forecasts->links() }}
            </div>
        @endif
    </div>

</div>

</body>
</html>