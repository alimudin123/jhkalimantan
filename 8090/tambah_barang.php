<?php
include 'config.php';

// Fungsi untuk mengupload gambar
function uploadImage($file)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileName = basename($file['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $targetDir = 'uploads/';
    $targetFile = $targetDir . uniqid() . '.' . $fileExtension;

    if (!in_array($fileExtension, $allowedExtensions)) {
        return ['status' => 'error', 'message' => 'Format gambar tidak diizinkan.'];
    }

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return ['status' => 'success', 'filePath' => $targetFile];
    } else {
        return ['status' => 'error', 'message' => 'Gagal mengunggah gambar.'];
    }
}

// Tambah Produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_barang']))  {
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

    $filePath = null;
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($_FILES['productImage']);
        if ($uploadResult['status'] === 'error') {
            $errors[] = $uploadResult['message'];
        } else {
            $filePath = $uploadResult['filePath'];
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO produk (nama, harga, stok, foto, rating, penilaian, penjualan, kategori, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$productName, $productPrice, $productStock, $filePath, $productRating, $productReviews, $productSold, $productCategory, $productGender]);
        header("Location: tambah_barang.php");
        exit;
    }
}

// Hapus Produk
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT foto FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        if (file_exists($product['foto'])) {
            unlink($product['foto']); // Hapus file gambar
        }
        $stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: index.php");
    exit;
}

// Ambil semua produk
$stmt = $pdo->query("SELECT * FROM produk");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="">
    <style>

        /* Default styles */
        body,
        h1,
        h2,
        p,
        table,
        th,
        td,
        button,
        input,
        select {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        /* Header styles */
        header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        header h1 {
            margin-bottom: 10px;
        }

        /* Button styles */
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        /* Form styles */
        h2 {
            margin: 20px 0 10px;
            font-size: 24px;
            color: #4a4a4a;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        /* Link styles */
        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <h1>Manajemen Produk</h1>
        <button onclick="window.location.href='admin.php'">Ke Halaman Admin</button>
    </header>

    <h2>Tambah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="productName" placeholder="Nama Produk" required>
        <input type="number" name="productPrice" placeholder="Harga" required>
        <input type="number" name="productStock" placeholder="Stok" required>
        <input type="file" name="productImage" required>
        <input type="number" name="productRating" placeholder="Rating" step="0.1" required>
        <input type="number" name="productReviews" placeholder="Jumlah Penilaian" required>
        <input type="number" name="productSold" placeholder="Jumlah Penjualan" required>

        <select name="productCategory" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="tas">Tas</option>
            <option value="jam_tangan">Jam Tangan</option>
            <option value="dompet">Dompet</option>
        </select>

        <select name="productGender" required>
            <option value="" disabled selected>Untuk Siapa</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select>

        <button type="submit" name="tambah_barang">Tambah Produk</button>
    </form>

    <h2>Daftar Produk</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Rating</th>
            <th>Penilaian</th>
            <th>Penjualan</th>
            <th>Kategori</th>
            <th>Gender</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['nama'] ?></td>
                <td><?= $product['harga'] ?></td>
                <td><?= $product['stok'] ?></td>
                <td><img src="<?= $product['foto'] ?>" alt="Foto Produk" width="100"></td>
                <td><?= $product['rating'] ?></td>
                <td><?= $product['penilaian'] ?></td>
                <td><?= $product['penjualan'] ?></td>
                <td><?= $product['kategori'] ?></td>
                <td><?= $product['gender'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
                    <a href="?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>