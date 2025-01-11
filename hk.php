<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami</title>
    <link rel="icon" href="./images/logojhk.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .container-hk {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 20px;
        }

        .map-container {
            flex: 2;
            margin-top: 55px;
            padding: 10px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: 0;
            border-radius: 10px;
        }

        .follow-us {
            flex: 1;
            padding: 20px;
            margin-top: 55px;
            margin-left: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        .follow-us h3 {
            background-color: #EE4D2D;
            width: 350px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            padding: 10px;
            margin-bottom: 40px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .follow-us h3:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .social-media-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 1.3em;
            font-weight: 500;
        }

        .social-media-list li {
            display: flex;
            align-items: center;
            margin: 10px 0;
            line-height: 2;
        }

        .social-media-list li i {
            margin-right: 10px;
            font-size: 1.5em;
            color: #333;
        }

        .social-media-list li a {
            text-decoration: none;
            color: #333;
        }

        .social-media-list li a:hover {
            color: #EE4D2D;
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
                <li><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li class="active"><a href="hk.php">Hubungi Kami</a></li>
                <li><a href="pengguna/user_akun.php">Akun</a></li>
            </ul>
        </nav>
    </header>

    <div class="container-hk">
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7932.286627614889!2d114.78960791534367!3d-3.801560137263965!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMy43OTcgU8KwNDcnMjAiTiAxMTTCsDQ3JzIwLjYiRQ!5e0!3m2!1sen!2sid!4v1678732912820"
                loading="lazy" allowfullscreen=""></iframe>
        </div>

        <div class="follow-us">
            <h3>Follow Us</h3>
            <ul class="social-media-list">
                <li><a href="https://api.whatsapp.com/send?phone=6285393567971"><i class="fas fa-phone-alt"></i> +62 853-9356-7971</a></li>
                <li><a href="https://shopee.co.id/jhkalimantan#product_list"><i class="fas fa-store"></i> Shopee: jhkalimantan</a></li>
                <li><a href="https://www.instagram.com/jimshoneykalimantan"><i class="fab fa-instagram"></i> Instagram: @jimshoneykalimantan</a></li>
                <li><a href="https://www.tiktok.com/@jimshoneykalimantan"><i class="fab fa-tiktok"></i> TikTok: @jimshoneykalimantan</a></li>
            </ul>
        </div>
    </div>
    <script src="burger.js"></script>
</body>


</html>