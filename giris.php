<?php
session_start();

// Veritabanı bağlantısı için gerekli bilgiler
$host = "localhost";
$user = "root"; // MySQL kullanıcı adınız
$password = ""; // MySQL şifreniz
$database = "KupAkman"; // Kullanmak istediğiniz veritabanı adı

// Veritabanı bağlantısını oluştur
$baglanti = new mysqli($host, $user, $password, $database);

// Bağlantıyı kontrol et
if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

// Formdan gelen verileri al
$userName = $_POST["userName"];
$userPassword = $_POST["userPassword"];


// Veritabanında kullanıcıyı sorgula
$sql = "SELECT * FROM users WHERE userName = '$userName' AND userPassword = '$userPassword'";
$result = $baglanti->query($sql);

// Kullanıcı var mı kontrol et
if ($result->num_rows > 0) {
    // Oturum bilgilerini kaydet
    $_SESSION["userName"] = $userName;

    // Kullanıcı adı "admin" ise admin.php sayfasına yönlendir
    if ($userName === "admin") {
        header("Location: admin.php");
    } else {
        // Diğer kullanıcıları giriş sayfasına yönlendir
        header("Location: index.php");
    }
    
    exit();
} else {
    echo "Kullanıcı adı veya şifre hatalı.";
}
// Veritabanı bağlantısını kapat
$baglanti->close();


