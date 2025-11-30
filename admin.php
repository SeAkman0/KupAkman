<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "KupAkman";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Giriş kontrolü
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $userName = $_POST["userName"];
    $password = $_POST["password"];

    // Basit kullanıcı doğrulaması (Bu kısımda veritabanı kontrolü yapılmalı)
    if ($userName === "admin" && $password === "admin123") {
        $_SESSION["userName"] = $userName;
        header("Location: admin.php");
        exit();
    } else {
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}

// Ürün ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    if (!isset($_SESSION["userName"]) || $_SESSION["userName"] !== "admin") {
        header("Location: admin.php");
        exit();
    }

    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["type"];
    $target_dir = "img/";
    $image = $_FILES["image"]["name"];
    $target_file = $target_dir . basename($image);

    // Dosya yükleme işlemi
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_dir . $image;
        $sql = "INSERT INTO products (name, price, image, type) VALUES ('$name', '$price', '$image_path', '$type')";

        if ($conn->query($sql) === TRUE) {
            echo "Ürün başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Ürün resmi yüklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="customcss/style.css">
    <style>
        body { background: #f5f7fb; }
        .auth-card { max-width: 420px; }
        .panel-card { max-width: 720px; }
        .brand-title { letter-spacing: .5px; font-weight: 600; }
    </style>
</head>
<body class="d-flex min-vh-100">
    <div class="container my-auto py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-auto text-center">
                <h1 class="brand-title h3 text-dark mb-0">KupAkman • Admin</h1>
                <div class="text-secondary small">Yönetim Paneli</div>
            </div>
        </div>

        <?php if (!isset($_SESSION["userName"]) || $_SESSION["userName"] !== "admin"): ?>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="card shadow-sm auth-card mx-auto">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h5 mb-4 text-center">Admin Giriş</h2>
                            <form action="admin.php" method="post" class="needs-validation" novalidate>
                                <input type="hidden" name="login" value="1">
                                <div class="mb-3">
                                    <label for="userName" class="form-label">Kullanıcı Adı</label>
                                    <input type="text" class="form-control" id="userName" name="userName" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Şifre</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm panel-card mx-auto">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h5 mb-4 text-center">Ürün Ekleme Paneli</h2>
                            <form action="admin.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="add_product" value="1">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="name" class="form-label">Ürün Adı</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="price" class="form-label">Ürün Fiyatı</label>
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="type" class="form-label">Ürün Türü</label>
                                        <input type="text" class="form-control" id="type" name="type" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="image" class="form-label">Ürün Resmi</label>
                                        <input class="form-control" type="file" id="image" name="image" required>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-success">Ürünü Ekle</button>
                                    <a href="index.php" class="btn btn-outline-secondary">Ana Sayfaya Dön</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
