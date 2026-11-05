@extends('layouts.app')

@section('content')


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

    {{-- Hero Section (Judul: IT Management & Software Development) --}}
    @include('partials.hero')

    {{-- Section Biodata & CV --}}
    @include('partials.biodata')

    {{-- Section Managed Services & IT Infrastructure --}}
    @include('partials.managed-services')

    {{-- Section Live API Tester --}}
    @include('partials.api-tester')

    {{-- Section Arsitektur Sistem --}}
    @include('partials.architecture')

    {{-- Section Kontak & Footer --}}
    @include('partials.contact')

@endsection

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
            // Ganti URL ini dengan endpoint Python API kamu nantinya
            // Contoh simulasi fetch:
            await new Promise(resolve => setTimeout(resolve, 300)); 
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