async function uploadAndScanOcr() {
    const fileInput = document.getElementById('ocrFile');
    const outputElement = document.getElementById('ocrResultOutput');
    const statusElement = document.getElementById('ocrStatus');
    const btn = document.getElementById('ocrSubmitBtn');

    if (!fileInput || fileInput.files.length === 0) {
        alert('Silakan pilih file gambar terlebih dahulu!');
        return;
    }

    const formData = new FormData();
    formData.append('file', fileInput.files[0]);

    btn.innerText = "Memindai Teks...";
    btn.disabled = true;
    statusElement.innerText = "PROCESSING OCR...";
    outputElement.textContent = "// Mengirim gambar ke backend FastAPI via EasyOCR...";

    try {
        const response = await fetch('https://zaini-portfolio-py-production.up.railway.app/api/v1/ai-wms/ocr-scan', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Gagal memproses OCR (Status: ${response.status})`);
        }

        const data = await response.json();
        outputElement.textContent = data.extracted_text;
        statusElement.innerText = "SUCCESS (200 OK)";
    } catch (error) {
        outputElement.textContent = `[ERROR]: ${error.message}\nPastikan server FastAPI aktif di port 8001.`;
        statusElement.innerText = "FAILED";
    } finally {
        btn.innerText = "Proses Scan OCR";
        btn.disabled = false;
    }
}