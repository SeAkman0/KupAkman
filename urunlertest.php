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
$sql = "SELECT name, price, image FROM products";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 20px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            padding: 20px;
            background-color: #fff;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .card h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .card p {
            font-size: 1em;
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            // Ürün verilerini döngü ile oluştur
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['price']) . " TL</p>";
                echo "</div>";
                
            }
        } else {
            echo "Ürün bulunamadı.";
        }
        // Veritabanı bağlantısını kapat
        $connection->close();
        ?>
        
        
    </div>
    <form action="satinAl.php" method="post">
    <input type="hidden" name="name" value="
    <?php
    echo htmlspecialchars($row['name']);
    ?>">
    <input type="hidden" name="price" value="
    <?php
    echo htmlspecialchars($row['price']);
    ?>">
    <input type="hidden" name="image" value="
    <?php
    echo htmlspecialchars($row['image']);
    ?>">
    <button type="submit" class="btn btn-primary">Satın Al</button>
</form>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>
