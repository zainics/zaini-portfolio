// ============================================================
// VEHICLE DASHBOARD PLAYBACK INTEGRATION
// Requires existing elements:
// #videoPlayer, #videoPlaceholder, #captureFeedContainer,
// #statTotalVehicles, #feedStatus, #processBtn, #videoFile
// ============================================================

const VEHICLE_DETECT_API_URL = `${FASTAPI_BASE_URL}/api/v1/vehicle/detect`;
const VEHICLE_WS_ENDPOINT = WS_ENDPOINT;

let vehicleWs = null;
let activeVideoId = null;
let playbackSync = null;
let statusPollTimer = null;
let playbackStarted = false;
let lastRenderedCount = -1;

// Helper untuk mengatur visualisasi placeholder video (Idle vs Processing)
function setVideoPlaceholderState(state, fileName = '') {
    const placeholder = document.getElementById('videoPlaceholder');
    if (!placeholder) return;

    if (state === 'processing') {
        placeholder.innerHTML = `
            <div class="flex flex-col items-center justify-center p-6 text-center space-y-4">
                <div class="relative flex items-center justify-center w-16 h-16">
                    <div class="absolute inset-0 rounded-full border-4 border-cyan-500/20"></div>
                    <div class="absolute inset-0 rounded-full border-4 border-t-cyan-400 border-r-transparent border-b-transparent border-l-transparent animate-spin"></div>
                    <div class="w-3 h-3 rounded-full bg-cyan-400 animate-ping"></div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-mono font-bold text-cyan-400 tracking-wider animate-pulse">
                        [GPU AI ENGINE PROCESSING]
                    </p>
                    <p class="text-[11px] font-mono text-slate-400 max-w-xs truncate">
                        Menganalisis frame: ${fileName || 'video.mp4'}
                    </p>
                </div>
                <div class="w-48 h-1.5 bg-slate-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-cyan-500 via-blue-500 to-cyan-400 w-full animate-pulse"></div>
                </div>
            </div>
        `;
    } else {
        placeholder.innerHTML = `
            <div class="flex flex-col items-center justify-center p-6 text-center space-y-2">
                <div class="text-3xl opacity-80">🎥</div>
                <p class="text-xs font-mono font-bold text-cyan-400 tracking-wider">
                    [VIDEO PLAYER READY]
                </p>
                <p class="text-[11px] font-mono text-slate-400">
                    Unggah video untuk memulai proses deteksi.
                </p>
            </div>
        `;
    }
}

// Helper untuk mengatur state tombol proses
function setProcessButtonLoading(isLoading, label = 'Proses Deteksi Kendaraan (FastAPI GPU)') {
    const processBtn = document.getElementById('processBtn');
    if (!processBtn) return;

    processBtn.disabled = isLoading;
    if (isLoading) {
        processBtn.classList.add('opacity-70', 'cursor-not-allowed');
        processBtn.innerHTML = `
            <span class="inline-flex items-center justify-center gap-2">
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>${label}</span>
            </span>
        `;
    } else {
        processBtn.classList.remove('opacity-70', 'cursor-not-allowed');
        processBtn.textContent = label;
    }
}

function formatVideoTime(seconds) {
    const totalMs = Math.max(0, Math.round(Number(seconds || 0) * 1000));
    const minutes = Math.floor(totalMs / 60000);
    const secondsPart = Math.floor((totalMs % 60000) / 1000);
    const milliseconds = totalMs % 1000;
    return `${String(minutes).padStart(2, '0')}:` +
        `${String(secondsPart).padStart(2, '0')}.` +
        `${String(milliseconds).padStart(3, '0')}`;
}

function renderCaptureGrid(captures, currentTime) {
    const container = document.getElementById('captureFeedContainer');
    const visible = captures.filter(item => Number(item.time_detected) <= currentTime + 0.025);

    if (visible.length === lastRenderedCount) return;

    if (!visible.length) {
        lastRenderedCount = 0;
        container.replaceChildren();
        const empty = document.createElement('div');
        empty.className = 'col-span-2 h-full flex items-center justify-center text-center p-6 text-slate-600 font-mono text-xs';
        empty.textContent = '[PLAYBACK] Menunggu waktu capture pertama...';
        container.appendChild(empty);
        return;
    }

    if (lastRenderedCount <= 0 || visible.length < lastRenderedCount) {
        container.replaceChildren();
        lastRenderedCount = 0;
    }

    for (let i = lastRenderedCount; i < visible.length; i++) {
        const item = visible[i];
        const card = document.createElement('div');
        card.className = 'bg-slate-900 border border-cyan-500/40 rounded-lg p-2.5 flex flex-col shadow-lg animate-fadeIn';

        const imageWrap = document.createElement('div');
        imageWrap.className = 'w-full h-24 bg-slate-950 rounded-md overflow-hidden border border-slate-800 mb-2';
        const image = document.createElement('img');
        image.src = `${FASTAPI_BASE_URL}${item.image_url}`;
        image.alt = 'Vehicle capture';
        image.loading = 'lazy';
        image.className = 'w-full h-full object-cover';
        imageWrap.appendChild(image);

        const title = document.createElement('p');
        title.className = 'text-[11px] font-mono font-bold text-cyan-400 uppercase truncate';
        title.textContent = `${item.vehicle_type || 'Unknown'} #${item.track_id ?? '-'}`;

        const time = document.createElement('p');
        time.className = 'text-[10px] font-mono text-emerald-400';
        time.textContent = item.time_label || formatVideoTime(item.time_detected);

        const confidence = document.createElement('p');
        confidence.className = 'text-[10px] font-mono text-slate-400';
        confidence.textContent = `Conf: ${(Number(item.confidence || 0) * 100).toFixed(1)}%`;

        card.append(imageWrap, title, time, confidence);
        container.appendChild(card);
    }

    lastRenderedCount = visible.length;
}

function syncGridToVideoTime() {
    if (!playbackSync) return;
    renderCaptureGrid(playbackSync.captures, Number(playbackSync.video.currentTime || 0));
}

async function loadPlayback(videoId) {
    if (playbackStarted) return;
    playbackStarted = true;
    clearInterval(statusPollTimer);

    if (videoId) activeVideoId = videoId;

    const videoPlayer = document.getElementById('videoPlayer');
    const videoPlaceholder = document.getElementById('videoPlaceholder');
    const feedStatus = document.getElementById('feedStatus');

    setProcessButtonLoading(true, 'Memuat Playback Video...');

    try {
        const response = await fetch(`${FASTAPI_BASE_URL}/api/v1/vehicle/${activeVideoId}/playback`);
        const payload = await response.json();
        if (!response.ok) throw new Error(payload.detail || 'Gagal mengambil data playback');

        if (!payload.playback_ready) {
            throw new Error(
                `Playback belum siap. Status=${payload.status}; ` +
                `capture gagal=${payload.capture_jobs_failed || 0}; ` +
                `candidate terlewat=${payload.dropped_candidates || 0}`
            );
        }

        const captures = (payload.captures || []).sort(
            (a, b) => Number(a.time_detected) - Number(b.time_detected)
        );

        playbackSync = {
            video: videoPlayer,
            captures: captures
        };

        // 1. Sembunyikan animasi loading & tampilkan video hasil render
        videoPlaceholder.classList.add('hidden');
        videoPlayer.classList.remove('hidden');
        videoPlayer.pause();
        videoPlayer.src = `${FASTAPI_BASE_URL}${payload.processed_video}`;
        videoPlayer.load();

        // 2. Set waktu video awal ke detik capture pertama
        if (captures.length > 0 && Number(captures[0].time_detected) > 0) {
            videoPlayer.currentTime = Math.max(0, Number(captures[0].time_detected) - 0.1);
        }

        // 3. Render grid sesuai waktu awal video
        lastRenderedCount = -1;
        renderCaptureGrid(captures, videoPlayer.currentTime);

        videoPlayer.ontimeupdate = syncGridToVideoTime;
        videoPlayer.onseeked = syncGridToVideoTime;
        videoPlayer.onended = syncGridToVideoTime;

        // 4. Putar video otomatis begitu siap
        videoPlayer.oncanplay = async () => {
            try {
                await videoPlayer.play();
            } catch (err) {
                console.warn('Autoplay dicegah oleh browser, silakan klik play manual.', err);
            }
        };

        document.getElementById('statTotalVehicles').textContent = captures.length;
        feedStatus.textContent = 'Status: Video siap diputar — grid tersinkronisasi';

    } catch (error) {
        playbackStarted = false;
        setVideoPlaceholderState('ready');
        feedStatus.textContent = 'Status: Playback gagal';
        console.error(error);
        alert(error.message);
    } finally {
        setProcessButtonLoading(false);
    }
}

async function pollVideoStatus(videoId) {
    clearInterval(statusPollTimer);
    statusPollTimer = setInterval(async () => {
        try {
            const response = await fetch(`${FASTAPI_BASE_URL}/api/v1/vehicle/${videoId}/status`);
            if (!response.ok) return;
            const status = await response.json();

            if (status.status === 'completed' && status.playback_ready) {
                clearInterval(statusPollTimer);
                activeVideoId = videoId;
                await loadPlayback(videoId);
            } else if (status.status === 'completed_with_errors' || status.status === 'failed') {
                clearInterval(statusPollTimer);
                setVideoPlaceholderState('ready');
                document.getElementById('feedStatus').textContent = 'Status: Proses selesai dengan error';
                setProcessButtonLoading(false);
                alert(status.error || 'Sebagian capture gagal disimpan. Periksa log backend.');
            }
        } catch (error) {
            console.error('Status polling error:', error);
        }
    }, 2000);
}

function initVehicleWebSocket() {
    if (vehicleWs) vehicleWs.close();
    vehicleWs = new WebSocket(VEHICLE_WS_ENDPOINT);

    vehicleWs.onopen = () => console.log('[VEHICLE WS] Connected');
    vehicleWs.onmessage = async event => {
        try {
            const message = JSON.parse(event.data);
            if (message.video_id && message.video_id !== activeVideoId) return;

            if (message.status === 'processing_complete' && message.playback_ready) {
                await loadPlayback(message.video_id);
            } else if (message.status === 'processing_failed' ||
                       (message.status === 'processing_complete' && !message.playback_ready)) {
                clearInterval(statusPollTimer);
                setVideoPlaceholderState('ready');
                document.getElementById('feedStatus').textContent = 'Status: Proses selesai dengan error';
                setProcessButtonLoading(false);
            }
        } catch (err) {
            // Abaikan non-JSON
        }
    };

    vehicleWs.onclose = () => setTimeout(initVehicleWebSocket, 3000);
    vehicleWs.onerror = error => console.error('[VEHICLE WS] Error:', error);
}

async function processVideoDetection() {
    const fileInput = document.getElementById('videoFile');
    const feedStatus = document.getElementById('feedStatus');
    const videoPlayer = document.getElementById('videoPlayer');
    const videoPlaceholder = document.getElementById('videoPlaceholder');

    if (!fileInput.files.length) {
        alert('Silakan pilih berkas video terlebih dahulu!');
        return;
    }

    const selectedFile = fileInput.files[0];

    clearInterval(statusPollTimer);
    activeVideoId = null;
    playbackStarted = false;
    playbackSync = null;
    lastRenderedCount = -1;

    videoPlayer.pause();
    videoPlayer.removeAttribute('src');
    videoPlayer.load();
    videoPlayer.classList.add('hidden');
    videoPlaceholder.classList.remove('hidden');

    // Tampilkan animasi loading pada kotak video
    setVideoPlaceholderState('processing', selectedFile.name);

    const container = document.getElementById('captureFeedContainer');
    container.replaceChildren();
    const empty = document.createElement('div');
    empty.className = 'col-span-2 h-full flex items-center justify-center text-center p-6 text-slate-600 font-mono text-xs';
    empty.textContent = '[PROCESSING] Menunggu backend menyelesaikan capture...';
    container.appendChild(empty);
    document.getElementById('statTotalVehicles').textContent = '0';

    // Kunci tombol & tampilkan spinner di tombol
    setProcessButtonLoading(true, 'Memproses Video di Backend...');
    feedStatus.textContent = 'Status: Upload dan deteksi kendaraan...';

    try {
        const formData = new FormData();
        formData.append('file', selectedFile);

        const response = await fetch(VEHICLE_DETECT_API_URL, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (!response.ok) throw new Error(result.detail || 'Gagal memproses video');

        activeVideoId = result.video_id;
        feedStatus.textContent = 'Status: Backend sedang mendeteksi kendaraan dan menyimpan capture...';
        pollVideoStatus(activeVideoId);

    } catch (error) {
        console.error(error);
        setVideoPlaceholderState('ready');
        feedStatus.textContent = 'Status: Gagal';
        setProcessButtonLoading(false);
        alert(`Gagal memproses video: ${error.message}`);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initVehicleWebSocket();
});