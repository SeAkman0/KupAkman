<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "KupAkman";

// Veritabanı bağlantısını oluştur
$connection = new mysqli($host, $user, $password, $database);

// Bağlantıyı kontrol et
if ($connection->connect_error) {
    die("Bağlantı hatası: " . $connection->connect_error);
}

// Ürün verilerini veritabanından çek
$sql = "SELECT name, price, image, type FROM products";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="customcss/style.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JavaScript ve Popper.js -->
    
    <title>Bas Harf Temali</title>
    <link rel="icon" href="logo.png" type="image/icon type">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
            
            margin: 0 auto; /* Yatayda ortalamak için */
            max-width: 1600px; /* İçeriğin maksimum genişliğini belirleyin, isteğinize göre ayarlayabilirsiniz */

        }

        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }

        .card h3 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .card p {
            font-size: 1.2em;
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body class="back">
    <div class="anaDiv">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="logo.png" width="75px" height="75px">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Tüm Ürünler</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="basharftemali.php">Baş Harf Temalı</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active secilenNav" aria-current="page" href="dizifilmtemali.html">Dizi-Film Karakterleri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="ozelUrun.html">Kendi Tasarımını Yap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="girisYap.html">Giris Yap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="kayitOl.html">Uye Ol</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        
                        <a name="userName" href="userPage.php">Hesap Ayarları
                          
                        </a>
                    </form>
                </div>
            </div>
        </nav>

        <div id="carouselExample" class="carousel slide sliders">
            <div class="carousel-inner">
            <div class="carousel-item active">
                    <img src="img/mcqueen.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="img/openheimer.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="img/sally.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="img/behzat1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="img/friends.png" class="d-block w-100" alt="...">
                </div>
            </div>
        
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        

        <div class="buyukDiv">
            
        

            <div class="container">
                
        <?php
        if ($result->num_rows > 0) {
          // Ürün verilerini döngü ile oluştur
          while($row = $result->fetch_assoc()) {
              if ($row['type'] === 'film') {
                  echo "<div class='card'>";
                  echo "<form action='satinAl.php' method='POST'>";
                  echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                  echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                  echo "<p>" . htmlspecialchars($row['price']) . " TL</p>";
                  echo "<input type='hidden' name='name' value='" . htmlspecialchars($row['name']) . "'>";
                  echo "<input type='hidden' name='price' value='" . htmlspecialchars($row['price']) . "'>";
                  echo "<input type='hidden' name='image' value='" . htmlspecialchars($row['image']) . "'>";
                  
                  echo "<button type='submit' class='btn btn-primary w-100 mt-2'>Satın Al</button>";
                  echo "</form>";
                  echo "</div>";
              }
          }
      } else {
          echo "Ürün bulunamadı.";
      }
      
      

        // Veritabanı bağlantısını kapat
        $connection->close();
        ?>
        
        </div>
        </div>
    

   
    </div>
    

    <footer>
        <div class="footer-content">
            <div class="logo">
                <a href="index.php"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="categories">
                <h3>Kategoriler</h3>
                <ul>
                    <li><a href="index.php">Tüm Ürünler</a></li>
                    
                    <li><a href="basharftemali.php">Baş Harf Temalı Ürünler</a></li>
                    <li><a href="dizifilmtemali.php">Dizi-Film Karakterleri</a></li>
                    <li><a href="ozelUrun.html">Kendi Tasarımını Yap</a></li>
                </ul>
            </div>
            <div class="categories">
                <h3>Sosyal Medya</h3>
                <ul>
                    <li><a target="_blank" href="https://instagram.com/kupakman">Instagram</a></li>
                    <li><a target="_blank" href="#">Facebook</a></li>
                </ul>
            </div>
            <div class="contact">
                <h3>İletişim</h3>
                <p>Adres: 1234 Sokak, Şehir, Ülke</p>
                <p>Email: info@ornek.com</p>
                <p>Telefon: +90 123 456 7890</p>
            </div>
        </div>
    </footer>
</body>
</html>