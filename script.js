// Tunggu sampai seluruh konten DOM selesai dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', function() {

    // --- Modul Efek Mengetik ---
    // Fungsi ini menginisialisasi animasi mengetik pada halaman beranda
    const initTypingEffect = () => {
        // Ambil elemen HTML dengan ID 'typing-effect' (tempat animasi akan muncul)
        const typingElement = document.getElementById('typing-effect');

        // Hanya jalankan jika elemen animasi mengetik ada di halaman
        if (typingElement) {
            // Array kata-kata yang akan ditampilkan bergantian
            const words = ["Web Developer", "Desainer Grafis", "Mahasiswa", "Pecinta Teknologi"];
            let wordIndex = 0;        // Indeks kata saat ini dalam array
            let charIndex = 0;        // Indeks karakter saat ini dalam kata
            let isDeleting = false;   // Status apakah sedang dalam mode menghapus

            // Fungsi rekursif untuk menampilkan efek mengetik
            const type = () => {
                // Ambil kata saat ini dari array
                const currentWord = words[wordIndex];

                // Jika dalam mode menghapus, kurangi satu karakter dari teks
                if (isDeleting) {
                    typingElement.textContent = currentWord.substring(0, charIndex - 1); // Ambil substring dari awal hingga sebelum karakter terakhir
                    charIndex--; // Kurangi indeks karakter
                }
                // Jika bukan dalam mode menghapus, tambahkan satu karakter ke teks
                else {
                    typingElement.textContent = currentWord.substring(0, charIndex + 1); // Ambil substring dari awal hingga karakter berikutnya
                    charIndex++; // Tambah indeks karakter
                }

                // Kondisi: jika selesai mengetik kata dan bukan dalam mode menghapus
                if (!isDeleting && charIndex === currentWord.length) {
                    // Atur timeout untuk mulai menghapus setelah 2 detik
                    setTimeout(() => isDeleting = true, 2000);
                }
                // Kondisi: jika dalam mode menghapus dan sudah sampai ke awal kata
                else if (isDeleting && charIndex === 0) {
                    isDeleting = false; // Kembali ke mode mengetik
                    wordIndex = (wordIndex + 1) % words.length; // Ganti ke kata berikutnya (dengan loop)
                }

                // Tentukan kecepatan ketik (lebih cepat saat menghapus)
                const typingSpeed = isDeleting ? 100 : 200; // 100ms jika menghapus, 200ms jika mengetik
                // Atur timeout untuk memanggil fungsi type() lagi setelah jeda tertentu
                setTimeout(type, typingSpeed);
            };
            type(); // Mulai animasi dengan memanggil fungsi type() pertama kali
        }
    };

    // --- Modul Form Kontak ---
    // Fungsi ini menangani pengiriman form kontak dan modal sukses
    const initContactForm = () => {
        // Ambil elemen form kontak dari halaman
        const contactForm = document.getElementById('contact-form');

        // Hanya jalankan jika form kontak ada di halaman
        if (contactForm) {
            // Ambil elemen modal sukses dari halaman
            const successModal = document.getElementById('success-modal');

            // Tambahkan event listener untuk event submit form
            contactForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dari submit default (yang akan merefresh halaman)

                // Jika modal sukses ditemukan
                if (successModal) {
                    // Tampilkan modal dengan menambahkan kelas 'visible'
                    successModal.classList.add('visible');

                    // Sembunyikan modal dan reset form setelah jeda waktu
                    setTimeout(() => {
                        successModal.classList.remove('visible'); // Hapus kelas 'visible' untuk menyembunyikan modal
                        contactForm.reset(); // Reset semua input dalam form ke kondisi awal
                    }, 2500); // Delay 2.5 detik sebelum menyembunyikan modal
                }
            });
        }
    };

    // Inisialisasi semua modul fungsi
    initTypingEffect();   // Jalankan modul efek mengetik
    initContactForm();    // Jalankan modul form kontak
});
