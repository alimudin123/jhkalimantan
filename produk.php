<?php
include './8090/config.php';

// Retrieve search parameters from the URL
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$selectedCategory = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
$minPrice = isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : '';
$maxPrice = isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '';


// Build the query based on the received parameters
$query = "SELECT * FROM produk WHERE 1=1";

if (!empty($searchTerm)) {
    $query .= " AND nama LIKE :searchTerm";
}

if (!empty($selectedCategory) && $selectedCategory !== 'all') {
    $query .= " AND kategori = :selectedCategory";
}

if (!empty($minPrice)) {
    $query .= " AND harga >= :minPrice";
}

if (!empty($maxPrice)) {
    $query .= " AND harga <= :maxPrice";
}

// Prepare the statement
$stmt = $pdo->prepare($query);

// Bind parameters if they exist
if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}
if (!empty($selectedCategory) && $selectedCategory !== 'all') {
    $stmt->bindValue(':selectedCategory', $selectedCategory);
}
if (!empty($minPrice)) {
    $stmt->bindValue(':minPrice', (float)$minPrice);
}
if (!empty($maxPrice)) {
    $stmt->bindValue(':maxPrice', (float)$maxPrice);
}

// Execute the query
$stmt->execute();
$filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="produk.css">
    <link rel="stylesheet" href="h-style.css">
    <style>

    </style>
</head>

<body>
    <header>
        <div class="logo1">
            <img src="images/logojhk" alt="Jims Honey Kalimantan" class="logo-image1">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="belanja.php">Belanja</a></li>
                <li class="active"><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li><a href="hk.php">Hubungi Kami</a></li>
            </ul>
        </nav>
    </header>

    <div class="search-section">
        <form id="searchForm" onsubmit="return false;">
            <div class="input-wrapper">
                <input type="text" placeholder="Cari" id="search" name="search" aria-label="Cari">
            </div>
            <div class="input-wrapper">
                <select id="category" name="category">
                    <option value="">Kategori:</option>
                    <option value="">Semua</option>
                    <option value="tas">Tas</option>
                    <option value="jam_tangan">Jam Tangan</option>
                    <option value="dompet">Dompet</option>
                </select>
            </div>
            <div class="input-wrapper">
                <input type="number" placeholder="Harga Min:" name="min_price" id="min_price">
            </div>
            <div class="input-wrapper">
                <input type="number" placeholder="Harga Max:" name="max_price" id="max_price">
            </div>
            <button type="button" id="searchButton" onclick="filterProducts()">Cari Sekarang</button>
        </form>
    </div>

    <div class="product-carousel-p">
        <div class="product-container-p" id="productContainer">
            <?php if (count($filteredProducts) > 0): ?>
                <?php foreach ($filteredProducts as $product): ?>
                    <div class="product-item-p" data-kategori="<?= strtolower($product['kategori']) ?>" data-harga="<?= $product['harga'] ?>">
                        <?php $imagePath = "8090/" . $product['foto']; ?>
                        <img src="<?= $imagePath ?>" alt="Foto Produk" class="product-image-p">
                        <h3 class="product-name"><?= htmlspecialchars($product['nama']) ?></h3>
                        <div class="divider-p"></div>

                        <div class="product-info">
                            <p class="price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                            <p class="rating"><?= $product['rating'] ?></p>
                        </div>

                        <div class="penilaian">
                            <p class="penilaian"><?= $product['penilaian'] ?>+ penilaian</p>
                        </div>

                        <div class="divider-p"></div>

                        <div class="product-stock-sales">
                            <p class="stock">Stok: <?= $product['stok'] ?></p>
                            <div class="sales-rating">
                                <p class="sales">Penjualan: <?= $product['penjualan'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada produk yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Fungsi untuk memfilter produk berdasarkan input pencarian, kategori, dan rentang harga
        function filterProducts() {
            // Ambil nilai dari input dan dropdown
            const searchInput = document.getElementById('search').value.toLowerCase();
            const categorySelect = document.getElementById('category').value.toLowerCase();
            const minPrice = parseFloat(document.getElementById('min_price').value) || 0;
            const maxPrice = parseFloat(document.getElementById('max_price').value) || Infinity;

            // Ambil semua elemen produk
            const products = document.querySelectorAll('.product-item-p');

            // Loop melalui setiap produk untuk memeriksa apakah memenuhi kriteria filter
            products.forEach(product => {
                // Ambil data dari atribut produk
                const productName = product.querySelector('.product-name').textContent.toLowerCase();
                const productCategory = product.getAttribute('data-kategori');
                const productPrice = parseFloat(product.getAttribute('data-harga'));

                // Cek apakah produk memenuhi kriteria pencarian dan filter
                const matchesSearch = productName.includes(searchInput);
                const matchesCategory = categorySelect === '' || productCategory === categorySelect;
                const matchesPrice = productPrice >= minPrice && productPrice <= maxPrice;

                // Tampilkan atau sembunyikan produk berdasarkan kriteria
                if (matchesSearch && matchesCategory && matchesPrice) {
                    product.style.display = 'block'; // Tampilkan produk
                } else {
                    product.style.display = 'none'; // Sembunyikan produk
                }
            });
        }
    </script>
    <script src="produk.js"></script>

</body>

</html>