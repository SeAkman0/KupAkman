<?php
// POST verilerini al
$name = isset($_POST['name']) ? $_POST['name'] : 'Bilinmiyor';
$price = isset($_POST['price']) ? $_POST['price'] : 'Bilinmiyor';
$image = isset($_POST['image']) ? $_POST['image'] : 'Bilinmiyor';
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
    <title>Ürün İnceleme</title>
    <link rel="icon" href="logo.png" type="image/icon type">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-details {
            text-align: center;
            padding: 20px;
        }

        .product-details h3 {
            font-size: 2em;
            margin: 10px 0;
        }

        .product-details p {
            font-size: 1.2em;
            margin: 5px 0;
            color: #333;
        }

        .purchase-button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s;
        }

        .purchase-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-details">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="product-image">
            <h3><?php echo htmlspecialchars($name); ?></h3>
            <p><?php echo htmlspecialchars($price); ?> TL</p>
            <form>
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                <input type="hidden" name="image" value="<?php echo htmlspecialchars($image); ?>">
                
            </form>
        </div>
    </div>
</body>
</html>
