<?php
require 'config.php';
session_start();

// Inisialisasi variabel untuk error dan success
$error = '';
$success = '';

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Cek username di database
        $stmt = $pdo->prepare("SELECT * FROM user_login WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Cek apakah password benar
            if (password_verify($password, $user['password'])) {
                // Set session dan redirect
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username']; // Menyimpan username di session
                header("Location: user_akun.php");
                exit();
            } else {
                $error = "Username atau password salah.";
            }
        } else {
            $error = "Username atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #FFBDBD;
            border: none;
            color: black;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            
        }
        button:hover {
            background-color: #FFBDBD;
            color: black;
            font-weight: bold;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <?php if ($success) echo "<p class='success'>$success</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        <p><a href="lupa_pw.php">Lupa password?</a></p>
    </div>
</body>
</html>