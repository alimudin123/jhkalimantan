<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="icon" href="./images/logojhk.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">
    <style>
        /* Tentang Kami */
        .container-tk {
            background-color: #FFBDBD;
            padding: 20px;
            border-radius: 12px;
            max-width: 1000px;
            text-align: center;
            width: 90%;
            height: auto;
            margin: 30px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            top: auto;
            transform: none;
            margin-top: 60px;
        }


        h1 {
            font-size: 2.3em;
            margin: 10px 0;
        }

        h3 {
            font-size: 1.5em;
            margin: 14px 0;
            text-align: left;
            margin-left: 40px;
        }

        p {
            font-size: 1em;
            line-height: 1.5;
            margin: 0 40px;
        }

        ul,
        ol {
            font-size: 1.1em;
            text-align: left;
            margin-left: 15px;
        }

        .p1 {
            font-size: 1.1em;
            text-align: left;
            margin: 0 27px;
            padding: 0;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 768px) {
            .container-tk {
                padding: 15px;
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .container-tk {
                max-width: 90%;
                padding: 10px;
                border-radius: 8px;
                margin-top: 15px;
            }
        }

        /* End Tentang Kami */
    </style>
</head>

<body>
    <header>
        <div class="logo1">
            <a href="index.php">
                <img src="images/logojhk.png" alt="Jims Honey Kalimantan" class="logo-image1">
            </a>
        </div>
        <nav>
            <div class="burger-menu" onclick="toggleMenu()">&#9776;</div>
            <ul class="list" id="menu">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="belanja.php">Belanja</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li class="active"><a href="tk.php">Tentang Kami</a></li>
                <li><a href="hk.php">Hubungi Kami</a></li>
                <li><a href="pengguna/user_akun.php">Akun</a></li>
            </ul>
        </nav>
    </header>

    <div class="container-tk">
        <h1>Tentang Kami</h1>
        <p class="p1">
            Selamat datang di Jimshoney Kalimantan! Kami hadir untuk memberikan produk-produk berkualitas terbaik, mulai dari tas elegan, dompet praktis,
            hingga jam tangan stylish yang siap melengkapi gaya Anda.
        </p>
        <p class="p1">
            Dengan mengutamakan kualitas, desain modern, dan kepuasan pelanggan, kami
            selalu berusaha memberikan pengalaman belanja terbaik untuk Anda. Setiap produk dipilih
            dengan cermat agar tidak hanya fungsional tetapi juga tampil menarik untuk mendukung gaya hidup Anda sehari-hari.
        </p>
        <h3>Mengapa Kami</h3>
        <ul>
            <li>Produk Berkualitas: Material premium dan desain menarik.</li>
            <li>Pelayanan Terbaik: Kami siap membantu Anda kapan saja.</li>
            <li>Belanja Mudah: Tersedia di berbagai platform, termasuk Shopee untuk kemudahan transaksi.</li>
        </ul>
        <p class="p1">
            Kami percaya bahwa Anda layak mendapatkan yang terbaik, dan itulah komitmen kami dalam setiap produk yang kami tawarkan.
            Terima kasih sudah menjadi bagian dari perjalanan kami!
        </p>
    </div>

    <script src="burger.js"></script>
</body>


</html>