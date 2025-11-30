<?php
$host = "localhost";
$user = "root"; // MySQL kullanıcı adınız
$password = ""; // MySQL şifreniz
$database = "KupAkman"; // Kullanmak istediğiniz veritabanı adı

// Veritabanı bağlantısını oluştur
$baglanti = new mysqli($host, $user, $password, $database);

// Formdan gelen verileri al
$userName = $_POST["userName"];
$userMail = $_POST["userMail"];
$userPassword = $_POST["userPassword"];

// Veritabanına ekleme sorgusu
$sql = "INSERT INTO users (userName, userMail, userPassword) VALUES ('$userName', '$userMail', '$userPassword')";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglanti->query($sql) === TRUE) {
    header("Location: girisYap.html");
    echo "Kayıt başarıyla oluşturuldu";
    
} else {
    echo "Hata: " . $sql . "<br>" . $baglanti->error;
}

// Veritabanı bağlantısını kapat
$baglanti->close();
?>
