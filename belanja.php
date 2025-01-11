<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja</title>
    <link rel="icon" href="./images/logojhk.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">


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
                <li class="active"><a href="belanja.php">Belanja</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li><a href="hk.php">Hubungi Kami</a></li>
                <li><a href="pengguna/user_akun.php">Akun</a></li>
            </ul>
        </nav>
    </header>

    <div class="shopping-box">
        <a href="https://shopee.co.id/jhkalimantan?entryPoint=ShopBySearch&searchKeyword=jhkalimantan" class="link">Belanja Sekarang!</a>
        <p class="description">Klik dan langsung dapatkan produk favoritmu di Shopee!</p>
    </div>
    
    <script src="burger.js"></script>
</body>


</html>