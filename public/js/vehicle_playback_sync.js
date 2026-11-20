/* ============================================================
 * VEHICLE PLAYBACK GRID SYNC V1
 *
 * Usage:
 * const playback = new VehiclePlaybackSync({
 *   videoElement: document.getElementById('videoPlayer'),
 *   gridElement: document.getElementById('captureFeedContainer'),
 *   apiBaseUrl: 'http://127.0.0.1:8001'
 * });
 * await playback.load(videoId);
 *
 * Captures are shown cumulatively when their source-video
 * time_detected is <= video.currentTime. Seeking backwards
 * removes captures that are later than the selected time.
 * ============================================================ */

class VehiclePlaybackSync {
    constructor({ videoElement, gridElement, apiBaseUrl = '' }) {
        if (!videoElement || !gridElement) {
            throw new Error('videoElement and gridElement are required');
        }

        this.video = videoElement;
        this.grid = gridElement;
        this.apiBaseUrl = apiBaseUrl.replace(/\/$/, '');
        this.videoId = null;
        this.captures = [];
        this.visibleKey = '';

        this._onTimeUpdate = () => this.sync();
        this._onSeeked = () => this.sync(true);
        this._onEnded = () => this.sync(true);

        this.video.addEventListener('timeupdate', this._onTimeUpdate);
        this.video.addEventListener('seeked', this._onSeeked);
        this.video.addEventListener('ended', this._onEnded);
    }

    async load(videoId, { autoplay = true } = {}) {
        this.videoId = videoId;
        this.captures = [];
        this.visibleKey = '';
        this.grid.replaceChildren();

        const response = await fetch(
            `${this.apiBaseUrl}/api/v1/vehicle/${encodeURIComponent(videoId)}/playback`
        );

        if (!response.ok) {
            throw new Error(`Playback API failed: HTTP ${response.status}`);
        }

        const payload = await response.json();
        if (!payload.playback_ready) {
            throw new Error(
                `Video belum siap diputar. Status: ${payload.status}; ` +
                `capture gagal: ${payload.capture_jobs_failed || 0}; ` +
                `candidate terlewat: ${payload.dropped_candidates || 0}`
            );
        }

        this.captures = (payload.captures || [])
            .filter(item => Number.isFinite(Number(item.time_detected)))
            .sort((a, b) => Number(a.time_detected) - Number(b.time_detected));

        this.video.pause();
        this.video.src = `${this.apiBaseUrl}${payload.processed_video}`;
        this.video.load();

        this.video.addEventListener('loadedmetadata', () => {
            this.sync(true);
            if (autoplay) {
                this.video.play().catch(error => {
                    console.warn('[VEHICLE PLAYBACK] Autoplay blocked:', error);
                });
            }
        }, { once: true });

        return payload;
    }

    sync(force = false) {
        const currentTime = Number(this.video.currentTime || 0);
        const visible = this.captures.filter(
            item => Number(item.time_detected) <= currentTime + 0.025
        );

        const key = visible.map(item =>
            `${item.track_id}:${Number(item.time_detected).toFixed(3)}`
        ).join('|');

        if (!force && key === this.visibleKey) return;
        this.visibleKey = key;
        this.grid.replaceChildren();

        for (const item of visible) {
            this.grid.appendChild(this._createCard(item));
        }
    }

    _createCard(item) {
        const card = document.createElement('article');
        card.className = 'vehicle-capture-card';

        const image = document.createElement('img');
        image.src = `${this.apiBaseUrl}${item.image_url}`;
        image.alt = `${item.vehicle_type || 'Vehicle'} ${item.track_id || ''}`;
        image.loading = 'lazy';
        image.className = 'vehicle-capture-image';

        const title = document.createElement('div');
        title.className = 'vehicle-capture-title';
        title.textContent = `${item.vehicle_type || 'Unknown'} #${item.track_id ?? '-'}`;

        const timestamp = document.createElement('div');
        timestamp.className = 'vehicle-capture-time';
        timestamp.textContent = item.time_label || this.formatTime(item.time_detected);

        const confidence = document.createElement('div');
        confidence.className = 'vehicle-capture-confidence';
        confidence.textContent = `Confidence: ${(Number(item.confidence || 0) * 100).toFixed(1)}%`;

        card.append(image, title, timestamp, confidence);
        return card;
    }

    formatTime(seconds) {
        const totalMs = Math.max(0, Math.round(Number(seconds) * 1000));
        const minutes = Math.floor(totalMs / 60000);
        const secondsPart = Math.floor((totalMs % 60000) / 1000);
        const milliseconds = totalMs % 1000;
        return `${String(minutes).padStart(2, '0')}:` +
            `${String(secondsPart).padStart(2, '0')}.` +
            `${String(milliseconds).padStart(3, '0')}`;
    }

    destroy() {
        this.video.removeEventListener('timeupdate', this._onTimeUpdate);
        this.video.removeEventListener('seeked', this._onSeeked);
        this.video.removeEventListener('ended', this._onEnded);
    }
}

window.VehiclePlaybackSync = VehiclePlaybackSync;
