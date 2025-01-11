<?php
session_start();
require 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, tampilkan pesan dan tautan untuk login dan register
    $userLoginData = null; // Set data pengguna menjadi null
} else {
    // Ambil data pengguna dari database
    $stmt = $pdo->prepare("SELECT * FROM user_login WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $userLoginData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cek apakah data pengguna ditemukan
    if (!$userLoginData) {
        echo "Data pengguna tidak ditemukan.";
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Akun</title>
    <link rel="icon" href="../images/logojhk.png" type="image/png">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../h-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <header>
        <div class="logo1">
            <a href="../index.php">
                <img src="../images/logojhk.png" alt="Jims Honey Kalimantan" class="logo-image1">
            </a>
        </div>
        <nav>
            <div class="burger-menu" onclick="toggleMenu()">&#9776;</div>
            <ul class="list" id="menu">
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="../belanja.php">Belanja</a></li>
                <li><a href="../produk.php">Produk</a></li>
                <li><a href="../tk.php">Tentang Kami</a></li>
                <li><a href="../hk.php">Hubungi Kami</a></li>
                <li class="active"><a href="pengguna/user_akun.php">Akun</a></li>
            </ul>
        </nav>
    </header>

    <?php if ($userLoginData): ?>
        <h1 style="color: black; font-family: 'Arial', sans-serif; font-size: 2.5em; text-align: center; padding: 20px;">Akun Pengguna</h1>
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px; background-color: #ffffff; padding: 20px; border-radius: 10px; color: #000;">
            <!-- Bagian Kiri -->
            <div style="flex: 1; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <h2 style="margin-top: 0;">Informasi Akun</h2>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($userLoginData['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userLoginData['email']); ?></p>
                <p><strong>Telepon:</strong> <?php echo htmlspecialchars($userLoginData['phone']); ?></p>
                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($userLoginData['address']); ?></p>
            </div>

            <!-- Bagian Kanan -->
            <div style="flex: 1; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <h2 style="margin-top: 0;">Pengelolaan Informasi Pribadi</h2>
                <button onclick="location.href='update_akun.php'" style="display: block; width: 100%; padding: 10px; margin-bottom: 10px; background-color: #FFBDBD; color:rgb(0, 0, 0); font-weight: bold; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Perbarui Informasi Pribadi</button>
                <button onclick="location.href='logout.php'" style="display: block; width: 100%; padding: 10px; background-color: #FFBDBD; color:rgb(0, 0, 0); font-weight: bold; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Logout</button>
            </div>
        </div>


    <?php elseif (isset($someOtherCondition) && $someOtherCondition): ?>
        <!-- Tambahkan logika lain untuk kondisi tertentu -->
        <h2>Halaman Khusus</h2>
        <p>Anda sedang berada di mode khusus. Silakan lakukan tindakan tertentu.</p>

    <?php else: ?>
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 180px; height: 100%; background-color:rgb(255, 255, 255);">
            <div style="text-align: center; background-color: #FFBDBD; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <h2>Silakan Login atau Daftar</h2>
                <button onclick="location.href='login.php'" style="display: block; width: 100%; padding: 10px; margin-bottom: 10px; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0); border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">Login</button>
                <button onclick="location.href='register.php'" style="display: block; width: 100%; padding: 10px; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0); border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">Register</button>
            </div>
        </div>
    <?php endif; ?>
    <script src="../burger.js"></script>

</body>

</html>