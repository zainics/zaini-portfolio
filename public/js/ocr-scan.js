// Preview gambar saat dipilih
document.getElementById('ocrFile')?.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('imagePreviewContainer');
            if (preview && container) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
        }
        reader.readAsDataURL(file);
    }
});

async function uploadAndScanOcr() {
    const fileInput = document.getElementById('ocrFile');
    const outputElement = document.getElementById('ocrResultOutput');
    const statusElement = document.getElementById('ocrStatus');
    const submitBtn = document.getElementById('ocrSubmitBtn');

    if (!fileInput.files || fileInput.files.length === 0) {
        alert('Silakan pilih berkas gambar terlebih dahulu.');
        return;
    }

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('file', file); // Sesuaikan dengan parameter FastAPI Anda (misal: file / image)

    // Ubah base URL dari AI_ENDPOINT untuk menyesuaikan rute OCR FastAPI Anda
    // Contoh: Jika AI_ENDPOINT adalah ".../agent-chat", kita ambil base URL-nya atau buat rute khusus OCR
    let ocrEndpoint = typeof AI_ENDPOINT !== 'undefined' 
        ? AI_ENDPOINT.replace('/agent-chat', '/ocr-scan') 
        : 'http://127.0.0.1:8001/api/v1/ai-wms/ocr-scan';

    submitBtn.disabled = true;
    submitBtn.innerText = "Memproses OCR...";
    statusElement.innerText = "Mengunggah & Memindai...";
    outputElement.textContent = "// [PROCESSING] Mengirim gambar ke FastAPI OCR Engine...";

    try {
        const response = await fetch(ocrEndpoint, {
            method: 'POST',
            // Catatan: Jangan set header 'Content-Type': 'application/json' secara manual jika menggunakan FormData, 
            // karena browser akan otomatis mengatur multipart/form-data beserta boundary-nya.
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Gagal terhubung ke server FastAPI (Status: ${response.status})`);
        }

        const data = await response.json();
        
        statusElement.innerText = "Selesai (200 OK)";
        statusElement.className = "text-[11px] font-mono text-emerald-400";
        
        // Tampilkan hasil ekstraksi teks dari FastAPI
        outputElement.textContent = JSON.stringify(data, null, 4);

    } catch (error) {
        statusElement.innerText = "GAGAL";
        statusElement.className = "text-[11px] font-mono text-rose-400";
        
        outputElement.textContent = `[ERROR]: ${error.message}\nPastikan endpoint FastAPI aktif dan rute /ocr-scan tersedia.`;
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = "Proses Scan OCR";
    }
}