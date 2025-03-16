// scripts.js

document.addEventListener('DOMContentLoaded', () => {
    // Alert Button di Beranda
    const alertButton = document.getElementById('alertButton');
    if (alertButton) {
        alertButton.addEventListener('click', () => {
            alert('Tombol ini telah diklik!');
        });
    }

    // Formulir FAQ
    const faqForm = document.getElementById('faqForm');
    if (faqForm) {
        faqForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Ambil nilai dari form
            const name = document.getElementById('faqName').value;
            const email = document.getElementById('faqEmail').value;
            const question = document.getElementById('faqQuestion').value;

            // Validasi sederhana
            if(name && email && question){
                // Tampilkan alert sukses
                const alertPlaceholder = document.createElement('div');
                alertPlaceholder.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pertanyaan Anda telah dikirim! Terima kasih, ${name}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                document.querySelector('.container').insertBefore(alertPlaceholder, document.querySelector('.container').firstChild);

                // Reset form
                faqForm.reset();

                // Tutup modal setelah beberapa detik
                setTimeout(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('faqModal'));
                    modal.hide();
                }, 2000);
            } else {
                // Tampilkan alert error
                const alertPlaceholder = document.createElement('div');
                alertPlaceholder.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Mohon lengkapi semua bidang sebelum mengirim.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                document.querySelector('.container').insertBefore(alertPlaceholder, document.querySelector('.container').firstChild);
            }
        });
    }
});