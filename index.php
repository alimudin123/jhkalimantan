<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jims Honey Kalimantan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5em;
        }

        p {
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo1">
            <img src="images/logojhk" alt="Jims Honey Kalimantan" class="logo-image1">
        </div>
        <nav>
            <ul>
                <li class="active"><a href="index.php">Beranda</a></li>
                <li><a href="belanja.php">Belanja</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li><a href="hk.php">Hubungi Kami</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Gamabar Beranda -->
        <div class="image-gallery">
            <img src="images/model1.png" alt="Model 1" class="gallery-image">
            <img src="images/model2.png" alt="Model 2" class="gallery-image">
            <img src="images/model3.png" alt="Model 3" class="gallery-image">
            <img src="images/model4.png" alt="Model 4" class="gallery-image">
        </div>

        <!-- Bagian Pencarian -->
        <div class="search-section">
            <form id="searchForm" action="produk.php" method="GET">
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
                <button type="submit" id="searchButton">Cari Sekarang</button>
            </form>
        </div>

        <!-- Tentang JimsHoney Kalimantan -->
        <div class="content-section">
            <div class="content-wrapper">
                <div class="image-container">
                    <img src="images/model4.png" alt="Model4">
                </div>
                <div class="text-container" style="flex: 2;">
                    <h1 style="font-size: 2em; margin: 0;">YOU DESERVE THE BEST</h1>
                    <p style="font-size: 1.2em; margin: 10px 0;">
                        Setiap orang pasti ingin yang terbaik, dan kami di sini untuk mewujudkannya. Mulai dari produk berkualitas, layanan yang ramah, hingga pengalaman yang bikin nyaman, semua kami siapkan khusus buat kamu. Karena buat kami, kepuasan kamu adalah nomor satu.
                    </p>
                    <p style="font-size: 1.2em; margin: 10px 0;">
                        Jadi, kenapa pilih yang biasa aja kalau kamu bisa dapat yang terbaik? Yuk, cari tahu lebih banyak dan rasakan bedanya!
                    </p>
                    <a href="tk.php" style="display: inline-block; padding: 10px 20px; background-color: black; color: white; border-radius: 10px; text-decoration: none; font-size: 1em;">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Jenis Produk -->
        <div class="product-section">
            <h1>Produk</h1>
            <p>Temukan produk yang sesuai dengan gaya dan kebutuhan Anda karena kami percaya, Anda layak mendapatkan yang terbaik!</p>
            <div class="product-container">
                <div class="product-item">
                    <img src="images/dompet.jpg" alt="Dompet" class="product-image">
                    <h2>Dompet</h2>
                    <p>Praktis dan elegan, dirancang untuk menemani aktivitas sehari-hari. Desain modern, material berkualitas, dan ruang yang pas untuk semua kebutuhan Anda.</p>
                </div>
                <div class="product-item">
                    <img src="images/tas.jpg" alt="Tas" class="product-image">
                    <h2>Tas</h2>
                    <p>Kombinasi sempurna antara fungsi dan fashion. Koleksi tas kami hadir dengan desain stylish, material tahan lama, dan ruang yang luas untuk menunjang aktivitas Anda.</p>
                </div>
                <div class="product-item">
                    <img src="images/jt-jhw23.jpg" alt="Jam Tangan" class="product-image">
                    <h2>Jam Tangan</h2>
                    <p>Lebih dari sekadar penunjuk waktu, jam tangan kami melengkapi penampilan Anda dengan sentuhan elegan dan berkelas. Tampil percaya diri kapan saja dan di mana saja.</p>
                </div>
            </div>
        </div>

        <!-- Best Seller -->
        <div class="header-bs">
            <h1>Paling Laris!</h1>
            <p>Produk-produk favorit yang paling dicari dan disukai pelanggan ada di sini!</p>
        </div>
        <div class="product-carousel-bs">
            <div class="product-container-bs">
                <!-- Kotak Produk 1 -->
                <div class="product-item-bs">
                    <img src="images/w-kalu.jpg" alt="Produk 1" class="product-image-bs">
                    <h2>Moly Wallet</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 100.000</p>
                        <p>Rating: 4.5</p>
                    </div>
                    <div class="peilaian-bs">
                        <p>150+ Penilaian</p>
                    </div>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 20</p>
                        <p>Terjual: 50</p>
                    </div>
                </div>
                <!-- Kotak Produk 2 -->
                <div class="product-item-bs">
                    <img src="images/b-adeline.jpg" alt="Produk 2" class="product-image-bs">
                    <h2>Adeline Bag</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 200.000</p>
                        <p>Rating: 4.0</p>
                    </div>
                    <p>100+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 15</p>
                        <p>Terjual: 30</p>
                    </div>
                </div>
                <!-- Kotak Produk 3 -->
                <div class="product-item-bs">
                    <img src="images/jt-jhw23.jpg" alt="Produk 3" class="product-image-bs">
                    <h2>JHW 23</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 150.000</p>
                        <p>Rating: 4.8</p>
                    </div>
                    <p>200+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 25</p>
                        <p>Terjual: 70</p>
                    </div>
                </div>
                <!-- Kotak Produk 4 -->
                <div class="product-item-bs">
                    <img src="images/b-kindy.jpg" alt="Produk 4" class="product-image-bs">
                    <h2>Kindy Bag</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 120.000</p>
                        <p>Rating: 4.2</p>
                    </div>
                    <p>80+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 10</p>
                        <p>Terjual: 40</p>
                    </div>
                </div>
                <!-- Kotak Produk 5 -->
                <div class="product-item-bs">
                    <img src="images/jt-jhw30.jpg" alt="Produk 5" class="product-image-bs">
                    <h2>JHW 30</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 180.000</p>
                        <p>Rating: 4.9</p>
                    </div>
                    <p>300+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 5</p>
                        <p>Terjual: 90</p>
                    </div>
                </div>
                <!-- Kotak Produk 6 -->
                <div class="product-item-bs">
                    <img src="images/w-ocha.jpg" alt="Produk 6" class="product-image-bs">
                    <h2>Ocha Wallet</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 220.000</p>
                        <p>Rating: 4.3</p>
                    </div>
                    <p>60+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 8</p>
                        <p>Terjual: 20</p>
                    </div>
                </div>
                <!-- Kotak Produk 7 -->
                <div class="product-item-bs">
                    <img src="images/b-zora.jpg" alt="Produk 7" class="product-image-bs">
                    <h2>Zora Bag</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 250.000</p>
                        <p>Rating: 4.6</p>
                    </div>
                    <p>90+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 12</p>
                        <p>Terjual: 60</p>
                    </div>
                </div>
                <!-- Kotak Produk 8 -->
                <div class="product-item-bs">
                    <img src="images/jt-jhw51.jpg" alt="Produk 8" class="product-image-bs">
                    <h2>JHW 51</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 130.000</p>
                        <p>Rating: 4.1</p>
                    </div>
                    <p>110+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 18</p>
                        <p>Terjual: 45</p>
                    </div>
                </div>
                <!-- Kotak Produk 9 -->
                <div class="product-item-bs">
                    <img src="images/b-axel-waist.jpg" alt="Produk 9" class="product-image-bs">
                    <h2>Axel Waist Bag</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 160.000</p>
                        <p>Rating: 4.7</p>
                    </div>
                    <p>130+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 22</p>
                        <p>Terjual: 80</p>
                    </div>
                </div>
                <!-- Kotak Produk 10 -->
                <div class="product-item-bs">
                    <img src="images/w-sharla.jpg" alt="Produk 10" class="product-image-bs">
                    <h2>Sharla Wallet</h2>
                    <hr class="divider-bs">
                    <div class="product-price-rating-bs">
                        <p>Harga: Rp 190.000</p>
                        <p>Rating: 4.4</p>
                    </div>
                    <p>140+ Penilaian</p>
                    <hr class="divider-bs">
                    <div class="product-stock-sales-bs">
                        <p>Stok: 7</p>
                        <p>Terjual: 55</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer>
        <p>&copy; 2024 Jims Honey | Kalimantan. All rights reserved.</p>
    </footer>
</body>

</html>