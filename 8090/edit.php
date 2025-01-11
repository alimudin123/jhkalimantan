<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Produk tidak ditemukan.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $errors = [];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productRating = $_POST['productRating'];
    $productReviews = $_POST['productReviews'];
    $productSold = $_POST['productSold'];
    $productCategory = $_POST['productCategory'];
    $productGender = $_POST['productGender'];
    $productDescription = $_POST['productDescription'];
    $productLink = $_POST['productLink'];

    // Validasi input
    if (empty($productName) || empty($productPrice) || empty($productStock) || empty($productCategory) || empty($productGender) || empty($productDescription) || empty($productLink)) {
        $errors[] = "Semua kolom wajib diisi.";
    }

    // Mengatur nilai rating, penilaian, dan penjualan
    // Jika input kosong, gunakan nilai lama dari database
    if ($productRating === '') {
        $productRating = $product['rating']; // Tetap menggunakan nilai lama jika kosong
    } elseif ($productRating < 0) {
        $productRating = 0; // Set ke 0 jika nilai kurang dari 0
    }

    if ($productReviews === '') {
        $productReviews = $product['penilaian']; // Tetap menggunakan nilai lama jika kosong
    } elseif ($productReviews < 0) {
        $productReviews = 0; // Set ke 0 jika nilai kurang dari 0
    }

    if ($productSold === '') {
        $productSold = $product['penjualan']; // Tetap menggunakan nilai lama jika kosong
    } elseif ($productSold < 0) {
        $productSold = 0; // Set ke 0 jika nilai kurang dari 0
    }

    $filePath = $product['foto']; // Simpan path gambar lama
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($_FILES['productImage']);
        if ($uploadResult['status'] === 'error') {
            $errors[] = $uploadResult['message'];
        } else {
            // Hapus gambar lama jika ada
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $filePath = $uploadResult['filePath'];
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE produk SET nama = ?, harga = ?, stok = ?, foto = ?, rating = ?, penilaian = ?, penjualan = ?, kategori = ?, gender = ?, deskripsi = ?, link = ? WHERE id = ?");
        $stmt->execute([$productName, $productPrice, $productStock, $filePath, $productRating, $productReviews, $productSold, $productCategory, $productGender, $productDescription, $productLink, $id]);
        header("Location: tambah_barang.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        /* Gaya Umum Halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Judul Halaman */
        h1 {
            margin-top: 20px;
            font-size: 2em;
            color: #333;
        }

        /* Gaya Formulir */
        form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 500px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Input dan Select */
        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        /* Textarea */
        form textarea {
            resize: vertical;
            height: 100px;
        }

        /* Select Dropdown */
        form select {
            appearance: none;
            background-color: #fff;
            cursor: pointer;
        }

        /* Tombol Submit */
        form button {
            background-color: #4CAF50;
            color: white;
            font-size: 1em;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        form button:hover {
            background-color: #45a049;
        }

        /* Fokus pada Input */
        form input:focus,
        form textarea:focus,
        form select:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        /* Responsif untuk Layar Kecil */
        @media (max-width: 480px) {
            form {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>

<body>
    <h1>Edit Produk</h1>
    <form method="POST" enctype="multipart/form-data">
        <!-- Keterangan untuk kolom nama produk -->
        <label for="productName">
            <h4>Nama Produk</h4>
        </label>
        <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($product['nama']) ?>" required>

        <!-- Keterangan untuk kolom harga produk -->
        <label for="productPrice">
            <h4>Harga Produk</h4>
        </label>
        <input type="number" id="productPrice" name="productPrice" value="<?= htmlspecialchars($product['harga']) ?>" required>

        <!-- Keterangan untuk kolom stok produk -->
        <label for="productStock">
            <h4>Stok Produk</h4>
        </label>
        <input type="number" id="productStock" name="productStock" value="<?= htmlspecialchars($product['stok']) ?>" required>

        <!-- Keterangan untuk kolom gambar produk -->
        <label for="productImage">
            <h4>Gambar Produk</h4>
        </label>
        <input type="file" id="productImage" name="productImage">

        <!-- Keterangan untuk kolom rating produk -->
        <label for="productRating">
            <h4>Rating Produk</h4>
        </label>
        <input type="number" id="productRating" name="productRating" value="<?= htmlspecialchars($product['rating']) ?>" step="0.1" required>

        <!-- Keterangan untuk kolom jumlah penilaian -->
        <label for="productReviews">
            <h4>Jumlah Penilaian</h4>
        </label>
        <input type="number" id="productReviews" name="productReviews" value="<?= htmlspecialchars($product['penilaian']) ?>" required>

        <!-- Keterangan untuk kolom jumlah terjual -->
        <label for="productSold">
            <h4>Jumlah Terjual</h4>
        </label>
        <input type="number" id="productSold" name="productSold" value="<?= htmlspecialchars($product['penjualan']) ?>" required>

        <!-- Keterangan untuk kolom deskripsi produk -->
        <label for="productDescription">
            <h4>Deskripsi Produk</h4>
        </label>
        <textarea id="productDescription" name="productDescription" required><?= htmlspecialchars($product['deskripsi']) ?></textarea>

        <!-- Keterangan untuk kategori produk -->
        <label for="productCategory">
            <h4>Kategori Produk</h4>
        </label>
        <select id="productCategory" name="productCategory" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="tas" <?= $product['kategori'] === 'tas' ? ' selected' : '' ?>>Tas</option>
            <option value="jam_tangan" <?= $product['kategori'] === 'jam_tangan' ? 'selected' : '' ?>>Jam Tangan</option>
            <option value="dompet" <?= $product['kategori'] === 'dompet' ? 'selected' : '' ?>>Dompet</option>
        </select>

        <!-- Keterangan untuk gender produk -->
        <label for="productGender">
            <h4>Gender Produk</h4>
        </label>
        <select id="productGender" name="productGender" required>
            <option value="pria" <?= $product['gender'] === 'pria' ? 'selected' : '' ?>>Pria</option>
            <option value="wanita" <?= $product['gender'] === 'wanita' ? 'selected' : '' ?>>Wanita</option>
        </select>

        <!-- Keterangan untuk link produk -->
        <label for="productLink">
            <h4>Link Produk</h4>
        </label>
        <input type="url" id="productLink" name="productLink" value="<?= htmlspecialchars($product['link']) ?>" placeholder="Link Produk" required>

        <!-- Tombol untuk mengirimkan form -->
        <button type="submit" name="update_product">Update Produk</button>
    </form>
</body>

</html>