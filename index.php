<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Informasi metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <title>Beranda - CV Rizky Setiawan</title> <!-- Judul halaman yang muncul di tab browser -->
    <style>
        /* Import font Google Poppins untuk tampilan teks yang lebih modern */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        /* Variabel CSS untuk tema warna yang digunakan secara global */
        :root {
            --primary-color: #00bfa5; /* Warna utama teal hijau */

            /* Tema Gelap (Default) */
            --background-color-dark: #121212;           /* Warna latar belakang gelap */
            --surface-color-dark: #1e1e1e;              /* Warna permukaan konten gelap */
            --text-color-dark: #e0e0e0;                 /* Warna teks utama gelap */
            --text-secondary-color-dark: #a0a0a0;       /* Warna teks sekunder gelap */

            /* Tema Terang */
            --background-color-light: #f4f4f9;          /* Warna latar belakang terang */
            --surface-color-light: #ffffff;             /* Warna permukaan konten terang */
            --text-color-light: #1c1c1e;                /* Warna teks utama terang */
            --text-secondary-color-light: #555555;      /* Warna teks sekunder terang */

            --sidebar-width: 250px; /* Lebar sidebar navigasi */
        }

        /* Reset margin dan padding untuk semua elemen */
        * {
            margin: 0;              /* Hapus margin default */
            padding: 0;             /* Hapus padding default */
            box-sizing: border-box; /* Atur box-sizing agar termasuk padding dan border */
        }

        /* Styling untuk elemen body */
        body {
            font-family: 'Poppins', sans-serif;     /* Gunakan font Poppins */
            background-color: var(--background-color-dark); /* Gunakan warna latar belakang gelap */
            color: var(--text-color-dark);          /* Gunakan warna teks gelap */
            display: flex;                          /* Gunakan flexbox untuk layout */
            transition: background-color 0.3s, color 0.3s; /* Transisi smooth saat ubah tema */
            min-height: 100vh;                     /* Minimum tinggi layar penuh */
        }

        /* Styling untuk body saat dalam mode terang */
        body.light-mode {
            background-color: var(--background-color-light); /* Ubah ke warna latar belakang terang */
            color: var(--text-color-light);                   /* Ubah ke warna teks terang */
        }

        /* Sidebar navigasi kiri */
        .sidebar {
            width: var(--sidebar-width);           /* Tetapkan lebar sidebar menggunakan variabel */
            height: 100vh;                        /* Tinggi penuh layar */
            background-color: var(--surface-color-dark); /* Warna latar belakang sidebar */
            position: fixed;                      /* Sidebar tetap saat scroll */
            top: 0;                              /* Posisi atas */
            left: 0;                             /* Posisi kiri */
            padding: 1.5rem 0;                   /* Padding vertikal */
            border-right: 1px solid #2a2a2a;     /* Garis batas kanan */
            display: flex;                       /* Gunakan flexbox */
            flex-direction: column;               /* Susunan kolom vertikal */
            align-items: center;                  /* Rata tengah horizontal */
            transition: background-color 0.3s, border-color 0.3s; /* Transisi perubahan warna */
        }

        /* Styling sidebar saat dalam mode terang */
        body.light-mode .sidebar {
            background-color: var(--surface-color-light); /* Ubah ke warna sidebar terang */
            border-right: 1px solid #e0e0e0;              /* Ubah ke garis batas terang */
        }

        /* Header sidebar berisi foto profil dan judul */
        .sidebar-header {
            margin-bottom: 1.5rem; /* Jarak bawah dari header */
            text-align: center;    /* Teks rata tengah */
        }

        /* Gambar profil di sidebar */
        .sidebar-profile-pic {
            width: 80px;                 /* Lebar gambar profil */
            height: 80px;                /* Tinggi gambar profil */
            border-radius: 50%;          /* Bentuk bulat */
            border: 3px solid var(--primary-color); /* Border dengan warna utama */
            margin-bottom: 1rem;         /* Jarak bawah dari gambar */
            object-fit: cover;           /* Potong gambar agar pas dalam kotak */
        }

        /* Sembunyikan gambar profil di sidebar saat di halaman utama */
        .home-page .sidebar-profile-pic {
            display: none; /* Sembunyikan gambar profil */
        }

        /* Judul "CV Digital" di sidebar */
        .sidebar-header h3 {
            color: var(--primary-color); /* Warna sesuai warna utama */
            font-weight: 700;            /* Bobot huruf tebal */
            font-size: 1.5rem;           /* Ukuran huruf */
        }

        /* Daftar menu navigasi dalam sidebar */
        .sidebar ul {
            list-style: none; /* Hilangkan bullet list */
            width: 100%;      /* Lebar penuh sidebar */
            flex-grow: 1;     /* Isi ruang yang tersedia secara vertical */
        }

        /* Link menu di sidebar */
        .sidebar ul li a {
            display: block;                              /* Buat link menjadi blok penuh */
            color: var(--text-secondary-color-dark);    /* Warna teks default */
            text-decoration: none;                       /* Hilangkan garis bawah */
            padding: 1rem 2rem;                          /* Padding dalam link */
            transition: all 0.3s ease;                   /* Transisi animasi saat hover */
            font-weight: 400;                           /* Bobot huruf normal */
        }

        /* Warna link saat dalam mode terang */
        body.light-mode .sidebar ul li a {
            color: var(--text-secondary-color-light); /* Warna teks dalam mode terang */
        }

        /* Efek hover pada menu */
        .sidebar ul li a:hover {
            background-color: rgba(0, 191, 165, 0.1); /* Latar belakang transparan hijau */
            color: var(--primary-color);               /* Warna teks menjadi warna utama */
            border-left: 4px solid var(--primary-color); /* Garis kiri saat hover */
            padding-left: calc(2rem - 4px);            /* Sesuaikan padding kiri */
        }

        /* Menu aktif (halaman saat ini) */
        .sidebar ul li a.active {
            color: var(--primary-color);               /* Warna teks warna utama */
            font-weight: 600;                         /* Bobot huruf sedikit lebih tebal */
            border-left: 4px solid var(--primary-color); /* Garis kiri tebal */
            padding-left: calc(2rem - 4px);            /* Sesuaikan padding */
        }

        /* Container untuk switch tema */
        .theme-switcher-container {
            padding: 1rem 2rem; /* Padding untuk penempatan switch */
            text-align: center; /* Rata tengah konten */
        }

        /* Switch untuk toggle tema gelap/terang */
        .theme-switcher {
            position: relative; /* Relatif terhadap elemen lain */
            display: inline-block; /* Tampilan inline block */
            width: 60px;         /* Lebar switch */
            height: 34px;        /* Tinggi switch */
        }

        /* Input checkbox untuk switch (tidak terlihat) */
        .theme-switcher input {
            opacity: 0;   /* Sembunyikan input */
            width: 0;     /* Lebar nol */
            height: 0;    /* Tinggi nol */
        }

        /* Slider track dari switch */
        .slider {
            position: absolute; /* Posisi absolut terhadap parent */
            cursor: pointer;    /* Pointer saat hover */
            top: 0;            /* Atas paling atas */
            left: 0;           /* Kiri paling kiri */
            right: 0;          /* Kanan paling kanan */
            bottom: 0;         /* Bawah paling bawah */
            background-color: #333; /* Warna latar belakang switch */
            transition: .4s;   /* Transisi perubahan warna */
            border-radius: 34px; /* Sudut melengkung */
        }

        /* Handle slider (bulatan yang bisa digeser) */
        .slider:before {
            position: absolute; /* Posisi absolut terhadap slider */
            content: "";       /* Isi kosong (untuk pseudo-element) */
            height: 26px;      /* Tinggi handle */
            width: 26px;       /* Lebar handle */
            left: 4px;         /* Jarak dari kiri saat posisi off */
            bottom: 4px;       /* Jarak dari bawah */
            background-color: white; /* Warna handle putih */
            transition: .4s;   /* Transisi perubahan posisi */
            border-radius: 50%; /* Bentuk bulat */
        }

        /* Warna slider saat dicentang (mode terang aktif) */
        input:checked + .slider {
            background-color: var(--primary-color); /* Warna dengan warna utama */
        }

        /* Posisi handle saat dicentang (mode terang aktif) */
        input:checked + .slider:before {
            transform: translateX(26px); /* Geser handle ke kanan */
        }

        /* Konten utama halaman */
        .content {
            margin-left: var(--sidebar-width); /* Jarak dari kiri (menghindari sidebar) */
            padding: 3rem;                    /* Padding di dalam konten */
            width: calc(100% - var(--sidebar-width)); /* Lebar bersih (kurangi sidebar) */
            animation: fadeIn 0.8s ease-in-out; /* Animasi fade saat halaman dimuat */
            display: flex;                     /* Gunakan flexbox */
            justify-content: center;           /* Rata tengah horizontal */
            align-items: center;               /* Rata tengah vertikal */
            min-height: 100vh;                /* Minimal tinggi layar penuh */
            position: relative;                /* Posisi relatif untuk positioning anak */
        }

        /* Animasi fade in saat halaman dimuat */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); } /* Awalnya transparan dan turun 20px */
            to { opacity: 1; transform: translateY(0); }      /* Akhirnya opak dan posisi normal */
        }

        /* Bagian hero (gambar profil, nama, dan deskripsi) */
        .hero {
            text-align: center;      /* Teks rata tengah */
            display: flex;           /* Gunakan flexbox */
            flex-direction: column;  /* Susunan vertikal */
            justify-content: center; /* Rata tengah horizontal */
            align-items: center;     /* Rata tengah vertikal */
            width: 100%;            /* Lebar penuh konten */
        }

        /* Judul nama */
        .hero h1 {
            font-size: 3.5rem;     /* Ukuran huruf besar */
            margin-bottom: 1rem;   /* Jarak bawah */
            font-weight: 700;      /* Bobot huruf tebal */
        }

        /* Paragraf deskripsi atau pekerjaan */
        .hero p {
            font-size: 1.5rem;                                     /* Ukuran huruf sedang */
            color: var(--text-secondary-color-dark);               /* Warna teks sesuai tema gelap */
            min-height: 2rem;                                      /* Tinggi minimum untuk teks */
        }

        /* Warna teks deskripsi saat dalam mode terang */
        body.light-mode .hero p {
            color: var(--text-secondary-color-light); /* Warna teks sekunder terang */
        }

        /* Container untuk gambar profil utama */
        .profile-pic-container {
            margin-bottom: 2rem;                /* Jarak bawah */
            display: flex;                      /* Gunakan flexbox */
            justify-content: center;            /* Rata tengah horizontal */
            align-items: center;                /* Rata tengah vertikal */
        }

        /* Bingkai gambar profil */
        .profile-pic-frame {
            width: 220px;                        /* Lebar bingkai */
            height: 220px;                       /* Tinggi bingkai */
            border-radius: 50%;                  /* Bentuk bulat */
            border: 4px solid var(--primary-color); /* Border dengan warna utama */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Bayangan lembut */
            display: flex;                       /* Gunakan flexbox */
            justify-content: center;             /* Rata tengah horizontal */
            align-items: center;                 /* Rata tengah vertikal */
            overflow: hidden;                    /* Sembunyikan bagian gambar yang keluar bingkai */
            background-color: var(--surface-color-dark); /* Latar belakang sesuai tema gelap */
            transition: transform 0.3s ease;     /* Transisi saat efek hover */
        }

        /* Efek zoom saat hover ke frame profil */
        .profile-pic-frame:hover {
            transform: scale(1.05); /* Besarkan sedikit saat hover */
        }

        /* Warna frame profil saat dalam mode terang */
        body.light-mode .profile-pic-frame {
            background-color: var(--surface-color-light); /* Latar belakang light theme */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);   /* Bayangan lebih ringan */
        }

        /* Gambar profil dalam frame */
        .profile-pic {
            width: 100%;          /* Isi lebar frame penuh */
            height: 100%;         /* Isi tinggi frame penuh */
            object-fit: cover;    /* Potong gambar agar pas dalam frame */
        }

        /* Styling untuk efek mengetik (typing effect) */
        #typing-effect {
            color: var(--primary-color); /* Warna sesuai warna utama */
            font-weight: 600;            /* Bobot huruf sedikit tebal */
        }

        /* Responsiveness untuk perangkat mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;         /* Sidebar penuhi lebar layar */
                height: auto;        /* Tinggi otomatis */
                position: relative;  /* Posisi relatif (tidak tetap) */
                padding: 1rem 0;     /* Padding vertikal */
            }

            .content {
                margin-left: 0;              /* Hilangkan margin kiri */
                width: 100%;                 /* Lebar penuh */
                padding: 2rem 1rem;          /* Padding kiri-kanan lebih kecil */
            }

            .hero h1 {
                font-size: 2.5rem;          /* Ukuran huruf lebih kecil */
            }

            .hero p {
                font-size: 1.2rem;          /* Ukuran huruf lebih kecil */
            }

            .profile-pic-frame {
                width: 180px;               /* Lebar frame lebih kecil */
                height: 180px;              /* Tinggi frame lebih kecil */
            }
        }
    </style>
</head>
<!-- Body dengan kelas home-page untuk styling spesifik -->
<body class="home-page">
    <!-- Navigasi sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <!-- Gambar profil di sidebar (digunakan untuk semua halaman kecuali home) -->
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80" alt="Foto Profil" class="sidebar-profile-pic">
            <h3>CV Digital</h3> <!-- Judul aplikasi di sidebar -->
        </div>
        <!-- Menu navigasi -->
        <ul>
            <!-- Aktif berarti ini adalah halaman saat ini -->
            <li><a href="index.php" class="active">Beranda</a></li>
            <li><a href="tentang.php">Tentang Saya</a></li>
            <li><a href="pendidikan.php">Pendidikan</a></li>
            <li><a href="pengalaman.php">Pengalaman</a></li>
            <li><a href="kontak.php">Kontak</a></li>
            <li><a href="artikel.php">Artikel</a></li>
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <header class="hero">
            <!-- Container gambar profil utama -->
            <div class="profile-pic-container">
                <div class="profile-pic-frame">
                    <!-- Gambar profil utama dari file foto.jpeg -->
                    <img src="foto.jpeg" alt="Foto Profil Rizky Setiawan" class="profile-pic">
                </div>
            </div>
            <!-- Nama pemilik CV -->
            <h1>Rizky Setiawan</h1>
            <!-- Paragraf dengan efek mengetik -->
            <p><span id="typing-effect"></span></p>
        </header>
    </main>
    <!-- File JavaScript untuk efek mengetik dan fungsi interaktif -->
    <script src="script.js"></script>
</body>
</html>