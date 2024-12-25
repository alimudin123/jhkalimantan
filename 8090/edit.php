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

    if (empty($productName) || empty($productPrice) || empty($productStock) || empty($productRating) || empty($productReviews) || empty($productSold) || empty($productCategory) || empty($productGender)) {
        $errors[] = "Semua kolom wajib diisi.";
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
        $stmt = $pdo->prepare("UPDATE produk SET nama = ?, harga = ?, stok = ?, foto = ?, rating = ?, penilaian = ?, penjualan = ?, kategori = ?, gender = ? WHERE id = ?");
        $stmt->execute([$productName, $productPrice, $productStock, $filePath, $productRating, $productReviews, $productSold, $productCategory, $productGender, $id]);
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
</head>

<body>
    <h1>Edit Produk</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="productName" value="<?= $product['nama'] ?>" required>
        <input type="number" name="productPrice" value="<?= $product['harga'] ?>" required>
        <input type="number" name="productStock" value="<?= $product['stok'] ?>" required>
        <input type="file" name="productImage">
        <input type="number" name="productRating" value="<?= $product['rating'] ?>" step="0.1" required>
        <input type="number" name="productReviews" value="<?= $product['penilaian'] ?>" required>
        <input type="number" name="productSold" value="<?= $product['penjualan'] ?>" required>
        <select name="productCategory" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="tas" <?= $product['kategori'] === 'tas' ? 'selected' : '' ?>>Tas</option>
            <option value="jam_tangan" <?= $product['kategori'] === 'jam_tangan' ? 'selected' : '' ?>>Jam Tangan</option>
            <option value="dompet" <?= $product['kategori'] === 'dompet' ? 'selected' : '' ?>>Dompet</option>
        </select>
        <select name="productGender" required>
            <option value="pria" <?= $product['gender'] === 'pria' ? 'selected' : '' ?>>Pria</option>
            <option value="wanita" <?= $product['gender'] === 'wanita' ? 'selected' : '' ?>>Wanita</option>
        </select>
        <button type="submit" name="update_product">Update Produk</button>
    </form>
</body>

</html>