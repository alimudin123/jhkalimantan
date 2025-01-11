<?php
include './8090/config.php'; // Pastikan koneksi ke database

// Cek apakah ada parameter ID produk
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    // Query untuk mendapatkan data produk berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        echo "<h2>Produk tidak ditemukan.</h2>";
        exit;
    }
} else {
    echo "<h2>ID produk tidak diberikan.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="icon" href="./images/logojhk.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #FFBDBD;
        }

        /* Product Container */
        .product-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Product Detail Layout */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 1000px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Product Image */
        .product-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-image img {
            max-width: 360px;
            max-height: 450px;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-image img:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: 'Kanit', sans-serif;
            color: #333;
            line-height: 1.5;
            margin-left: 10px;
        }

        .product-details h2 {
            margin-bottom: 15px;
            font-size: 1.8em;
            color: black;
        }

        .product-details p {
            margin: 8px 0;
            font-size: 1.1em;
            color: #555;
        }

        /* Product Description */
        .product-description {
            grid-column: span 2;
            font-family: 'Kanit', sans-serif;
            padding: 30px;
        }

        /* Buy */
        .buy-button-container {
            display: flex;
            margin-left: 250px;
            justify-content: center;
            width: 100%;
        }

        .buy-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #d43f2d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .buy-button:hover {
            background-color: #d43f2d;
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }


        /* Back Icon */
        .back-icon {
            display: flex;
            align-items: center;
            margin-top: 18px;
            margin-left: 30px;
            text-decoration: none;
            color: rgb(50, 50, 50);
            font-size: 36px;
        }

        @media (max-width: 768px) {
            .product-container {
                padding: 10px;
            }

            .product-detail {
                display: flex;
                flex-direction: column;
                width: 100%;
                align-items: center;
            }


            .product-image img {
                max-width: 100%;
                height: auto;
            }

            .product-details {
                width: 100%;
                align-items: center;
            }

            .product-details p {
                text-align: center;
                width: 90%;
            }
            .buy-button-container {
                text-align: center;
                width: 60%;
                margin-right: 250px;
            }
        }
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
                <li class="active"><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li><a href="hk.php">Hubungi Kami</a></li>
                <li><a href="pengguna/user_akun.php">Akun</a></li>
            </ul>
        </nav>
    </header>

    <a href="produk.php" class="back-icon">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="product-container">
        <div class="product-detail">
            <div class="product-image">
                <img src="<?= htmlspecialchars('8090/' . $product['foto']) ?>" alt="Foto Produk" class="product-img">
            </div>
            <div class="product-details">
                <h2><?= htmlspecialchars($product['nama']) ?></h2>
                <p><strong>Harga:</strong> Rp<?= number_format($product['harga'], 0, ',', '.') ?></p>
                <p><strong>Stok:</strong> <?= htmlspecialchars($product['stok']) ?></p>
                <p><strong>Rating:</strong> <?= htmlspecialchars($product['rating']) ?> / 5</p>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($product['kategori']) ?></p>
                <p><strong>Segmen:</strong> <?= htmlspecialchars($product['gender']) ?></p>
                <p><strong>Penilaian:</strong> <?= htmlspecialchars($product['penilaian']) ?></p>
                <p><strong>Penjualan:</strong> <?= htmlspecialchars($product['penjualan']) ?></p>
            </div>
            <div class="product-description">
                <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($product['deskripsi'])) ?></p>
            </div>
            <div class="buy-button-container">
            <a href="<?= htmlspecialchars($product['link']) ?>" class="buy-button">Beli Barang</a>
        </div>
        </div>
    </div>

</body>
<script src="burger.js"></script>

</html>