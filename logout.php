<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    http_response_code(200); // Başarılı yanıt
} else {
    http_response_code(400); // Kötü istek
}
?>
