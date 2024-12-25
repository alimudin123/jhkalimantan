<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split Layout with Map and Follow Us Section</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="h-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Hubungi Kami */
        .container-hk {
            display: flex;
            height: calc(100vh - 60px);
        }

        .map-container {
            flex: 2;
            padding: 0px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #map {
            width: 100%;
            height: 400px;
            border-radius: 10px;
        }

        .follow-us {
            flex: 1;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .follow-us-background {
            background-color: #EE4D2D;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            color: #FFFFFF;
            margin-bottom: 10px;
            width: 100%;
        }

        .social-media-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: medium;
            width: 100%;
        }

        .social-media-list li {
            display: flex;
            align-items: center;
            margin: 5px 0;
        }

        .social-media-list li i {
            margin-right: 10px;
            font-size: 1.5em;
        }

        /* End Hubungi Kami */
    </style>
</head>

<body>
    <header>
        <div class="logo1">
            <img src="images/logojhk" alt="Jims Honey Kalimantan" class="logo-image1 ">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="belanja.php">Belanja</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="tk.php">Tentang Kami</a></li>
                <li class="active"><a href="hk.php">Hubungi Kami</a></li>
            </ul>
        </nav>
    </header>

    <div class="container-hk">
        <div class="map-container">
            <h2>Our Locations</h2>
            <div id="map"></div>
        </div>
        <div class="follow-us">
            <div class="follow-us-background">
                Follow Us
            </div>
            <ul class="social-media-list">
                <li><i class="fab fa-whatsapp"></i> +62 853-9356-7971</li>
                <li><i class="fas fa-store"></i> jhkalimantan</li>
                <li><i class="fab fa-instagram"></i> @jimshoneykalimantan</li>
                <li><i class="fab fa-tiktok"></i> @jimshoneykalimantan</li>
            </ul>
        </div>
    </div>

    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {
                    lat: -0.7893,
                    lng: 113.9213
                },
            });

            const locations = [{
                title: "Jimshoney Kalimantan",
                position: {
                    lat: -0.7893,
                    lng: 113.9213
                }
            }, ];

            locations.forEach(location => {
                new google.maps.Marker({
                    position: location.position,
                    map: map,
                    title: location.title,
                });
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>

</body>

</html>