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
// Tambah Produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_barang'])) {
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

    // Validasi input
    if (empty($productName) || empty($productPrice) || empty($productStock) || empty($productCategory) || empty($productGender) || empty($productDescription)) {
        $errors[] = "Semua kolom wajib diisi.";
    }

    // Mengatur nilai rating, penilaian, dan penjualan
    // Jika input kosong, gunakan nilai 0 jika diisi dengan 0
    if ($productRating === '') {
        $productRating = 0; // Set ke 0 jika kosong
    }

    if ($productReviews === '') {
        $productReviews = 0; // Set ke 0 jika kosong
    }

    if ($productSold === '') {
        $productSold = 0; // Set ke 0 jika kosong
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
        $stmt = $pdo->prepare("INSERT INTO produk (nama, harga, stok, foto, rating, penilaian, penjualan, kategori, gender, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$productName, $productPrice, $productStock, $filePath, $productRating, $productReviews, $productSold, $productCategory, $productGender, $productDescription]);
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
    header("Location: tambah_barang.php");
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
    <meta name="viewport" content="width =device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="">
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        /* Header styles */
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        /* Button styles */
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /*Pop Up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            /* Pastikan overlay berada di atas konten lainnya */
        }

        .popup {
            font-family: Arial, sans-serif;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            /* Lebar popup 90% dari viewport */
            max-width: 500px;
            /* Maksimal lebar popup */
            box-sizing: border-box;
            /* Pastikan padding tidak menambah lebar */
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #333;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 600px) {
            .popup {
                padding: 15px;
                /* Kurangi padding pada perangkat kecil */
            }

            .close {
                font-size: 18px;
                /* Kecilkan ukuran font untuk tombol tutup */
            }
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
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="number"]:focus,
        form select:focus,
        form textarea:focus {
            border-color: #007bff;
            outline: none;
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
            transition: color 0.3s;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        /* Textarea styles */
        textarea {
            height: 100px;
            resize: vertical;
        }

        /* Error message styles */
        .error {
            color: red;
            margin-bottom: 15px;
        }

        /* Media Queries for Responsiveness */
        @media screen and (max-width: 600px) {
            header {
                padding: 15px;
            }

            form {
                padding: 15px;
            }

            button {
                width: 100%;
            }

            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 8px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        img {
            max-width: 100px;
            /* Membatasi lebar gambar */
            height: auto;
            /* Menjaga rasio aspek gambar */
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 600px) {

            th,
            td {
                padding: 8px;
                /* Mengurangi padding pada perangkat kecil */
                font-size: 14px;
                /* Mengurangi ukuran font */
            }

            img {
                max-width: 80px;
                /* Mengurangi ukuran gambar pada perangkat kecil */
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Manajemen Produk</h1>
        <button onclick="window.location.href='admin.php'">Ke Halaman Admin</button>
    </header>

    <h2>Tambah Produk</h2>
    <button id="openPopup">Tambah Barang</button>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup" id="popup">
            <span class="close" id="closePopup">&times;</span>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="productName" placeholder="Nama Produk" required>
                <input type="number" name="productPrice" placeholder="Harga" required>
                <input type="number" name="productStock" placeholder="Stok" required>
                <input type="file" name="productImage" required>
                <input type="number" name="productRating" placeholder="Rating" step="0.1" required>
                <input type="number" name="productReviews" placeholder="Jumlah Penilaian" required>
                <input type="number" name="productSold" placeholder="Jumlah Penjualan" required>
                <textarea name="productDescription" placeholder="Deskripsi Produk" required></textarea>
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

                <input type="url" name="productLink" placeholder="Link Produk" required>

                <button type="submit" name="tambah_barang">Tambah Produk</button>
            </form>
        </div>
    </div>

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
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Gender</th>
            <th>Link</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= htmlspecialchars($product['nama']) ?></td>
                <td><?= htmlspecialchars($product['harga']) ?></td>
                <td><?= htmlspecialchars($product['stok']) ?></td>
                <td><img src="<?= htmlspecialchars($product['foto']) ?>" alt="Foto Produk" width="100"></td>
                <td><?= htmlspecialchars($product['rating']) ?></td>
                <td><?= htmlspecialchars($product['penilaian']) ?></td>
                <td><?= htmlspecialchars($product['penjualan']) ?></td>
                <td><?= htmlspecialchars($product['deskripsi']) ?></td>
                <td><?= htmlspecialchars($product['kategori']) ?></td>
                <td><?= htmlspecialchars($product['gender']) ?></td>
                <td><a href="<?= htmlspecialchars($product['link']) ?>" target="_blank">Lihat Produk</a></td>
                <td>
                    <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
                    <a href="?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        document.getElementById('openPopup').addEventListener('click', function() {
            document.getElementById('popupOverlay').style.display = 'block';
        });

        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popupOverlay').style.display = 'none';
        });

        document.getElementById('popupOverlay').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</body>

</html>