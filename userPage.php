<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Paneli</title>
    <style>

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Kullanıcı Paneli</h2>
        <div class="success-message">
            <!-- Kullanıcı bilgileri başarıyla güncellendiğinde gösterilecek mesaj buraya gelecek -->
        </div>
        <div class="error-message">
            <!-- Hata mesajları buraya gelecek -->
        </div>
        <form id="userForm">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="userName" name="userName" value="<?php
                          if (isset($_SESSION['userName'])) {
                            $userName = $_SESSION['userName'];
                              echo $userName;
                          } else {
                              echo "Giriş Yapılmadı";
                          }
                          ?>">
                            
            </div>
            
            <button class="logout-button" onclick="logout()">Çıkış Yap</button>

<script>
    function logout() {
        fetch('logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'logout=true'
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'index.php';
            } else {
                console.error('Çıkış yapılamadı');
            }
        })
        .catch(error => {
            console.error('Hata:', error);
        });
    }
</script>
        </form>

            
        </form>
    </div>

                          
</body>

</html>