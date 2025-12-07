<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <title>Kontak - CV Saya</title> <!-- Judul halaman yang muncul di tab browser -->
    <!-- Link ke file CSS eksternal untuk styling dasar -->
    <link rel="stylesheet" href="style.css">

    <!-- CSS Internal untuk modal konfirmasi -->
    <style>
        /* Gaya overlay modal konfirmasi */
        .modal-overlay {
            position: fixed;              /* Posisi tetap saat scroll */
            top: 0;                     /* Posisi atas paling atas */
            left: 0;                    /* Posisi kiri paling kiri */
            width: 100%;                /* Lebar penuh layar */
            height: 100%;               /* Tinggi penuh layar */
            background-color: rgba(0, 0, 0, 0.6); /* Latar belakang transparan gelap */
            display: flex;              /* Gunakan flexbox */
            justify-content: center;     /* Rata tengah horizontal */
            align-items: center;         /* Rata tengah vertikal */
            z-index: 1000;              /* Z-index tinggi untuk muncul di atas konten */
            opacity: 0;                 /* Awalnya transparan */
            visibility: hidden;          /* Awalnya tidak terlihat */
            transition: opacity 0.3s ease, visibility 0.3s ease; /* Transisi saat tampil/sembunyi */
        }

        /* Gaya overlay saat modal terlihat */
        .modal-overlay.visible {
            opacity: 1;                 /* Buat menjadi terlihat */
            visibility: visible;        /* Buat menjadi terlihat */
        }

        /* Gaya konten modal */
        .modal-content {
            background-color: #ffffff;  /* Latar belakang putih */
            padding: 3rem 4rem;         /* Padding dalam modal */
            border-radius: 15px;        /* Sudut melengkung */
            text-align: center;         /* Teks rata tengah */
            position: relative;         /* Posisi relatif untuk tombol close */
            transform: scale(0.9);      /* Skala awal lebih kecil */
            transition: transform 0.3s ease; /* Transisi animasi */
        }

        /* Tombol close modal */
        .modal-close-btn {
            position: absolute;         /* Posisi absolut dalam modal */
            top: 10px;                 /* Jarak dari atas */
            right: 15px;               /* Jarak dari kanan */
            font-size: 2rem;           /* Ukuran huruf besar */
            color: #aaa;               /* Warna abu-abu */
            cursor: pointer;           /* Pointer saat hover */
            line-height: 1;            /* Tinggi baris */
            transition: color 0.2s ease; /* Transisi perubahan warna */
        }

        /* Warna tombol close saat hover */
        .modal-close-btn:hover {
            color: #333;               /* Warna lebih gelap saat hover */
        }

        /* Transformasi skala saat modal terlihat */
        .modal-overlay.visible .modal-content {
            transform: scale(1);        /* Kembali ke ukuran normal */
        }

        /* Gaya teks dalam modal */
        .modal-content p {
            color: #333;               /* Warna teks gelap */
            font-size: 1.2rem;         /* Ukuran huruf */
            font-weight: 600;          /* Bobot huruf lebih tebal */
            margin-top: 1rem;          /* Jarak atas dari teks */
        }

        /* Animasi centang dalam modal */
        .checkmark {
            width: 80px;               /* Lebar centang */
            height: 80px;              /* Tinggi centang */
            border-radius: 50%;        /* Bentuk bulat */
            display: block;            /* Tampilan sebagai blok */
            stroke-width: 3;           /* Ketebalan garis */
            stroke: #4caf50;           /* Warna hijau */
            stroke-miterlimit: 10;     /* Batas miter */
            margin: 0 auto;            /* Rata tengah horizontal */
            box-shadow: inset 0px 0px 0px #4caf50; /* Bayangan dalam */
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both; /* Dua animasi */
        }

        /* Lingkaran animasi centang */
        .checkmark-circle {
            stroke-dasharray: 166;     /* Jumlah dash untuk lingkaran */
            stroke-dashoffset: 166;    /* Offset awal */
            stroke-width: 3;           /* Ketebalan garis */
            stroke-miterlimit: 10;     /* Batas miter */
            stroke: #4caf50;           /* Warna hijau */
            fill: none;                /* Tidak diisi */
            animation: stroke .6s cubic-bezier(0.65, 0, 0.45, 1) forwards; /* Animasi stroke */
        }

        /* Garis centang */
        .checkmark-check {
            transform-origin: 50% 50%; /* Titik transformasi di tengah */
            stroke-dasharray: 48;      /* Jumlah dash untuk garis centang */
            stroke-dashoffset: 48;     /* Offset awal */
            stroke: #fff !important;   /* Paksa warna putih */
            animation: stroke .3s cubic-bezier(0.65, 0, 0.45, 1) .8s forwards; /* Animasi stroke */
        }

        /* Animasi untuk stroke garis */
        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;  /* Offset menjadi nol (menggambar penuh) */
            }
        }

        /* Animasi untuk skala */
        @keyframes scale {
            0%, 100% {
                transform: none;       /* Tidak ada transformasi */
            }
            50% {
                transform: scale3d(1.1, 1.1, 1); /* Diperbesar sedikit */
            }
        }

        /* Animasi untuk fill centang */
        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 40px #4caf50; /* Bayangan penuh dalam */
            }
        }
    </style>
</head>
<body>
    <!-- Navigasi sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <!-- Gambar profil di sidebar -->
            <img src="foto.jpeg" alt="Foto Profil" class="sidebar-profile-pic">
            <h3>CV Digital</h3> <!-- Judul aplikasi di sidebar -->
        </div>
        <!-- Menu navigasi -->
        <ul>
            <li><a href="index.php">Beranda</a></li> <!-- Link ke halaman beranda -->
            <li><a href="tentang.php">Tentang Saya</a></li> <!-- Link ke halaman tentang -->
            <li><a href="pendidikan.php">Pendidikan</a></li> <!-- Link ke halaman pendidikan -->
            <li><a href="pengalaman.php">Pengalaman</a></li> <!-- Link ke halaman pengalaman -->
            <li><a href="kontak.php" class="active">Kontak</a></li> <!-- Link ke halaman ini (aktif) -->
            <li><a href="artikel.php">Artikel</a></li> <!-- Link ke halaman artikel -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <!-- Kartu form kontak -->
        <section class="card">
            <h2>Hubungi Saya</h2> <!-- Judul form kontak -->

            <!-- Form kontak dengan ID untuk JavaScript -->
            <form id="contact-form" class="contact-form">
                <!-- Grup input nama -->
                <div class="form-group">
                    <label for="nama">Nama</label> <!-- Label untuk input nama -->
                    <input type="text" id="nama" name="nama" required> <!-- Input teks untuk nama (wajib) -->
                </div>

                <!-- Grup input email -->
                <div class="form-group">
                    <label for="email">Email</label> <!-- Label untuk input email -->
                    <input type="email" id="email" name="email" required> <!-- Input email untuk email (wajib) -->
                </div>

                <!-- Grup input pesan -->
                <div class="form-group">
                    <label for="pesan">Pesan</label> <!-- Label untuk input pesan -->
                    <textarea id="pesan" name="pesan" rows="5" required></textarea> <!-- Input teks area untuk pesan (wajib) -->
                </div>

                <!-- Tombol kirim -->
                <button type="submit" class="btn">Kirim Pesan</button> <!-- Tombol untuk mengirim form -->
            </form>
        </section>

        <!-- Kartu media sosial -->
        <section class="card">
            <h2>Media Sosial</h2> <!-- Judul seksi media sosial -->

            <!-- Tautan media sosial -->
            <div class="social-links">
                <a href="https://www.instagram.com/dhjak_?igsh=MnV4enAxNGtrZ3Vo" target="_blank">Instagram</a> <!-- Link Instagram -->
                <a href="https://github.com/SIBINN-CYBER/SIBINN-CYBER.github.io" target="_blank">GitHub</a> <!-- Link GitHub -->
                <a href="https://www.tiktok.com/@dhjak5?_t=ZS-8zDRoghvJfb&_r=1"  target="_blank">TikTok</a> <!-- Link TikTok -->
            </div>
        </section>

        <!-- Modal Konfirmasi Pesan Terkirim -->
        <div id="success-modal" class="modal-overlay">
            <div class="modal-content">
                <span class="modal-close-btn">&times;</span> <!-- Tombol close modal -->

                <!-- SVG animasi centang -->
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/> <!-- Lingkaran animasi -->
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/> <!-- Garis centang -->
                </svg>
                <p>Pesan Terkirim</p> <!-- Teks konfirmasi -->
            </div>
        </div>
    </main>

    <!-- Script JavaScript untuk fungsi form kontak -->
    <script>
        // Tunggu sampai DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen form kontak
            const contactForm = document.getElementById('contact-form');
            // Ambil elemen modal konfirmasi
            const successModal = document.getElementById('success-modal');
            // Ambil tombol close modal
            const closeBtn = document.querySelector('.modal-close-btn');
            // Variabel untuk menyimpan timeout
            let hideTimeout;

            // Fungsi untuk menyembunyikan modal
            const hideModal = () => {
                successModal.classList.remove('visible'); // Hapus kelas 'visible' dari modal
            };

            // Cek apakah semua elemen yang diperlukan ada
            if (contactForm && successModal && closeBtn) {
                // Tambahkan event listener untuk submit form
                contactForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah submit form standar (reload halaman)

                    // Ambil data dari form
                    const formData = new FormData(contactForm);
                    // Buat objek data dari form
                    const data = {
                        nama: formData.get('nama'),   // Ambil nilai dari input nama
                        email: formData.get('email'), // Ambil nilai dari input email
                        pesan: formData.get('pesan')  // Ambil nilai dari textarea pesan
                    };

                    // Kirim data ke backend melalui fetch API
                    fetch('save_message.php', {
                        method: 'POST',                // Gunakan metode POST
                        headers: { 'Content-Type': 'application/json' }, // Header JSON
                        body: JSON.stringify(data)     // Kirim data dalam format JSON
                    })
                    .then(response => response.json()) // Konversi respon ke JSON
                    .then(result => {
                        if (result.success) {
                            // Jika pengiriman sukses, tampilkan modal
                            successModal.classList.add('visible');
                            // Hapus timeout sebelumnya jika ada
                            clearTimeout(hideTimeout);
                            // Set timeout untuk menyembunyikan modal setelah 3 detik
                            hideTimeout = setTimeout(() => {
                                hideModal();           // Sembunyikan modal
                                contactForm.reset();   // Reset form
                            }, 3000);
                        } else {
                            // Jika pengiriman gagal, tampilkan pesan error
                            alert('Gagal mengirim pesan: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error); // Log error ke konsol
                        alert('Terjadi kesalahan koneksi.'); // Tampilkan pesan error
                    });
                });

                // Event listener untuk tombol close (X)
                closeBtn.addEventListener('click', () => {
                    clearTimeout(hideTimeout); // Hapus timeout sebelumnya
                    hideModal();              // Sembunyikan modal
                    contactForm.reset();      // Reset form
                });

                // Event listener untuk klik di luar area modal
                successModal.addEventListener('click', function(event) {
                    if (event.target === successModal) { // Jika klik di area overlay
                        clearTimeout(hideTimeout);      // Hapus timeout sebelumnya
                        hideModal();                     // Sembunyikan modal
                        contactForm.reset();             // Reset form
                    }
                });
            }
        });
    </script>
</body>
</html>