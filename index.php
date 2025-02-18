<?php
// Variabel-variabel untuk konten dinamis
$title = "Website Rendang";
$heroTitle = "Selamat Datang di Kelezatan Rendang";
$heroDescription = "Temukan berbagai resep dan informasi menarik seputar rendang, masakan khas Indonesia yang mendunia.";
$heroButtonText = "Resep Rendang";
$infoSectionTitle = "Varian Rendang Pilihan";

// Data rendang (contoh array)
$rendangs = [
    [
        'image' => 'images/sapi.jpeg', // Ganti path gambar
        'name' => 'Rendang Daging Sapi',
        'description' => 'Rendang klasik dengan daging sapi yang empuk dan bumbu kaya rasa.'
    ],
    [
        'image' => 'images/ayam.jpeg', // Ganti path gambar
        'name' => 'Rendang Ayam',
        'description' => 'Alternatif rendang yang lebih ringan dengan daging ayam yang lezat.'
    ],
    [
        'image' => 'images/jengkol.jpeg', // Ganti path gambar
        'name' => 'Rendang Jengkol',
        'description' => 'Bagi pecinta jengkol, wajib mencoba kelezatan rendang jengkol ini!'
    ]
];

// Variabel untuk formulir
$nama = $email = $pesan = "";
$namaErr = $emailErr = $pesanErr = "";
$berhasil = false;

// Proses formulir ketika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Nama
    if (empty($_POST["nama"])) {
        $namaErr = "Nama harus diisi";
    } else {
        $nama = test_input($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nama)) {
            $namaErr = "Hanya huruf dan spasi yang diizinkan";
        }
    }

    // Validasi Email
    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }

    // Validasi Pesan
    if (empty($_POST["pesan"])) {
        $pesanErr = "Pesan harus diisi";
    } else {
        $pesan = test_input($_POST["pesan"]);
    }

    // Jika tidak ada error, proses lebih lanjut (misalnya, kirim email)
    if (empty($namaErr) && empty($emailErr) && empty($pesanErr)) {
        // Di sini Anda bisa menambahkan kode untuk mengirim email
        // Contoh sederhana:
        $ke = "email@example.com"; // Ganti dengan email Anda
        $subjek = "Pesan dari Website Rendang";
        $isi = "Nama: ".$nama."\nEmail: ".$email."\nPesan: ".$pesan;
        $header = "Dari: ".$email;

        //mail($ke, $subjek, $isi, $header); // Fungsi mail() mungkin perlu konfigurasi di server

        $berhasil = true;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('image/background_rendang.jpg'); /* Ganti gambar latar */
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #444; /* Warna teks lebih gelap */
        }

        .navbar {
            background-color: rgba(139, 69, 19, 0.8); /* Cokelat tua semi-transparan */
        }

        .navbar a {
            color: #fff;
        }

        .hero-section {
            padding: 120px 20px;
            background: rgba(255, 250, 240, 0.8); /* Warna krem semi-transparan */
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            color: #8B4513; /* Cokelat tua */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-btn {
            display: inline-block;
            background-color: #A0522D; /* Cokelat tanah */
            color: #fff;
            padding: 18px 35px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.3rem;
            margin-top: 25px;
            transition: background-color 0.3s ease;
        }

        .hero-btn:hover {
            background-color: #8B4513; /* Cokelat tua */
        }

        .info-section {
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: #333;
        }

        .info-section h2 {
            font-size: 2.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 45px;
            color: #A0522D; /* Cokelat tanah */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .info-card {
            text-align: center;
            margin-bottom: 35px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card img {
            max-width: 100%;
            height: auto;
            max-height: 220px;
            border-radius: 12px;
            margin-bottom: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: #333;
        }

        .form-section h2 {
            font-size: 2.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 45px;
            color: #A0522D; /* Cokelat tanah */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background-color: #A0522D; /* Cokelat tanah */
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #8B4513; /* Cokelat tua */
        }

        html {
            scroll-behavior: smooth;
        }

        .error {
            color: #FF0000;
        } /* Gaya untuk pesan error */
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Rendang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#info">Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="#form">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div id="hero" class="container">
        <div class="hero-section">
            <h1 class="hero-title"><?php echo $heroTitle; ?></h1>
            <p><?php echo $heroDescription; ?></p>
            <a href="#info" class="hero-btn"><?php echo $heroButtonText; ?></a>
        </div>
    </div>

    <!-- Info Section -->
    <div id="info" class="container">
        <div class="info-section">
            <h2><?php echo $infoSectionTitle; ?></h2>
            <div class="row">
                <?php foreach ($rendangs as $rendang): ?>
                    <div class="col-lg-4 col-md-6 info-card">
                        <img src="<?php echo $rendang['image']; ?>" alt="<?php echo $rendang['name']; ?>">
                        <h5><?php echo $rendang['name']; ?></h5>
                        <p><?php echo $rendang['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div id="form" class="container">
        <div class="form-section">
            <h2>Hubungi Kami</h2>
            <?php if ($berhasil): ?>
                <p>Terima kasih! Pesan Anda telah terkirim.</p>
            <?php else: ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
                        <span class="error"><?php echo $namaErr;?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
                        <span class="error"><?php echo $emailErr;?></span>
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan:</label>
                        <textarea class="form-control" id="pesan" name="pesan" rows="5"><?php echo $pesan;?></textarea>
                        <span class="error"><?php echo $pesanErr;?></span>
                    </div>
                    <button type="submit" class="btn btn-submit">Kirim</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
