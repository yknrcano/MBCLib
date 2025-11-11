let html5QrcodeScannerInstance = null;

function startQrScanner() {
    const qrRegionId = "qr-reader";
    if (html5QrcodeScannerInstance) return;
    html5QrcodeScannerInstance = new Html5Qrcode(qrRegionId);
    Html5Qrcode.getCameras().then(cameras => {
        const camId = cameras[0]?.id;
        if (!camId) {
            alert("No camera found");
            return;
        }
        html5QrcodeScannerInstance.start(
            camId,
            { fps: 10, qrbox: 250 },
            qrCodeMessage => {
                onScanSuccess(qrCodeMessage);
            },
            errorMessage => {
                // Ignore scan errors
            }
        );
    }).catch(() => alert("Camera init failed"));
}

function stopQrScanner() {
    if (html5QrcodeScannerInstance) {
        html5QrcodeScannerInstance.stop().then(() => {
            html5QrcodeScannerInstance.clear();
            html5QrcodeScannerInstance = null;
        });
    }
}

function extractIsbn(text) {
    if (!text) return null;

    // Try labeled pattern first (handles both with and without colon)
    const labeled = text.match(/ISBN[:\s-]*([0-9Xx\-\s]{10,17})/i);
    if (labeled && labeled[1]) {
        const normalized = labeled[1].replace(/[\s-]/g, '');
        if (/^(97[89]\d{10}|\d{9}[\dXx])$/.test(normalized)) return normalized;
    }

    // Fallback: find any ISBN-13/10 anywhere in the string
    const cleaned = text.replace(/[^\dXx]/g, ''); // keep digits and X
    // Try 13-digit starting 978/979 first
    const isbn13 = text.match(/97[89]\d{10}/);
    if (isbn13) return isbn13[0];

    // Then 10-digit (may end with X)
    const isbn10 = text.match(/\b\d{9}[\dXx]\b/);
    if (isbn10) return isbn10[0];

    return null;
}

let scanMode = 'borrow';

function setScanMode(mode) {
    scanMode = mode;
}

function onScanSuccess(codeText) {
    stopQrScanner();

    fetch(`../functions/fetch_book.php?raw=${encodeURIComponent(codeText)}`)
        .then(async r => {
            const rawResp = await r.text();
            let data;
            try { data = JSON.parse(rawResp); } catch(e) { throw new Error('Bad JSON: '+rawResp); }
            if (!data.success) {
                alert(data.error || "Book not found");
                return;
            }

            const scanModalEl = document.getElementById('qrScanModal');
            bootstrap.Modal.getInstance(scanModalEl)?.hide();

            if (scanMode === 'borrow') {
                // Populate borrow form
                document.getElementById('ISBN').value = data.book.isbn || '';
                document.getElementById('Title').value = data.book.title || '';
                document.getElementById('Author').value = data.book.author || '';
                document.getElementById('book_id').value = data.book.id;
                document.getElementById('scan_code').value = codeText;

                const coverEl = document.getElementById('bookCover');
                coverEl.src = data.book.cover ? `../assets/book_cover/${data.book.cover}` : '../assets/default_cover.png';

                const now = new Date();
                const borrowDate = now.toISOString().slice(0, 16);
                document.getElementById('borrow_date').value = borrowDate;

                document.getElementById('bookDetailsSection').style.display = 'block';
                document.getElementById('scanQrBtn').style.display = 'none';

                const submitBtn = document.getElementById('borrowSubmitBtn');
                const idInput = document.getElementById('id_no');
                const returnInput = document.getElementById('return_date');
                const toggle = () => submitBtn.disabled = idInput.value.trim() === '' || returnInput.value === '';
                submitBtn.disabled = true;
                idInput.oninput = toggle;
                returnInput.oninput = toggle;
                toggle();

                let borrowModal = bootstrap.Modal.getInstance(document.getElementById('borrowBookModal'));
                if (!borrowModal) borrowModal = new bootstrap.Modal(document.getElementById('borrowBookModal'));
                borrowModal.show();
            } else if (scanMode === 'return') {
                // Populate return form
                const returnISBNEl = document.getElementById('returnISBN');
                if (returnISBNEl) returnISBNEl.value = data.book.isbn || '';
                const returnTitleEl = document.getElementById('returnTitle');
                if (returnTitleEl) returnTitleEl.value = data.book.title || '';
                const returnAuthorEl = document.getElementById('returnAuthor');
                if (returnAuthorEl) returnAuthorEl.value = data.book.author || '';
                const returnBookIdEl = document.getElementById('return_book_id');
                if (returnBookIdEl) returnBookIdEl.value = data.book.id;
                const returnScanCodeEl = document.getElementById('return_scan_code');
                if (returnScanCodeEl) returnScanCodeEl.value = codeText;

                const coverEl = document.getElementById('returnBookCover');
                if (coverEl) coverEl.src = data.book.cover ? `../assets/book_cover/${data.book.cover}` : '../assets/default_cover.png';

                // Fetch borrower
                fetch(`../functions/get_borrower.php?book_id=${data.book.id}`)
                    .then(r => {
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        return r.json();
                    })
                    .then(borrowerData => {
                        console.log('Borrower data:', borrowerData); // Debug
                        const borrowerEl = document.getElementById('returnStudentNumber');
                        if (borrowerEl) borrowerEl.value = borrowerData.student_number || 'Unknown';
                        const detailsEl = document.getElementById('returnBookDetailsSection');
                        if (detailsEl) detailsEl.style.display = 'block';
                        const scanBtnEl = document.getElementById('returnScanQrBtn');
                        if (scanBtnEl) scanBtnEl.style.display = 'none';

                        const submitBtn = document.getElementById('returnSubmitBtn');
                        if (submitBtn) submitBtn.disabled = borrowerData.student_number === 'Unknown';
                    })
                    .catch(err => {
                        console.error('Borrower fetch error:', err); // Debug
                        const borrowerEl = document.getElementById('returnStudentNumber');
                        if (borrowerEl) borrowerEl.value = 'Error fetching student number';
                        const detailsEl = document.getElementById('returnBookDetailsSection');
                        if (detailsEl) detailsEl.style.display = 'block';
                        const scanBtnEl = document.getElementById('returnScanQrBtn');
                        if (scanBtnEl) scanBtnEl.style.display = 'none';
                        const submitBtn = document.getElementById('returnSubmitBtn');
                        if (submitBtn) submitBtn.disabled = true;
                    });

                let returnModal = bootstrap.Modal.getInstance(document.getElementById('returnBookModal'));
                if (!returnModal) returnModal = new bootstrap.Modal(document.getElementById('returnBookModal'));
                returnModal.show();
            }
        })
        .catch(err => {
            console.error(err);
            alert("Fetch failed");
        });
}

// Modal lifecycle hooks
document.addEventListener('shown.bs.modal', (e) => {
    if (e.target.id === 'qrScanModal') {
        startQrScanner();
    }
});

document.addEventListener('hidden.bs.modal', (e) => {
    if (e.target.id === 'qrScanModal') {
        stopQrScanner();
    }
});