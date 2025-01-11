<?php
require 'config.php';
session_start();

// Inisialisasi variabel untuk error dan success
$error = '';
$success = '';

// Cek apakah token ada di URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cek apakah token valid
    $stmt = $pdo->prepare("SELECT * FROM user_login WHERE reset_token = :token");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $error = "Token tidak valid.";
    }

    // Cek apakah form telah disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        // Validasi input
        if (empty($newPassword) || empty($confirmPassword)) {
            $error = "Semua kolom harus diisi.";
        } elseif ($newPassword !== $confirmPassword) {
            $error = "Kata sandi tidak cocok.";
        } else {
            // Hash password baru
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Perbarui password di database dan hapus token
            $stmt = $pdo->prepare("UPDATE user_login SET password = :password, reset_token = NULL WHERE id = :id");
            $stmt->execute(['password' => $hashedPassword, 'id' => $user['id']]);

            $success = "Kata sandi berhasil diperbarui. Silakan login.";
        }
    }
} else {
    $error = "Token tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

        input[type="password"] {
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
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
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

        p {
            text-align: center;
            margin-top: 10px;
            color: rgb(0, 0, 0);
        }

        p a {
            text-decoration: underline;
            color: rgb(17, 0, 255);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <?php if ($success) echo "<p class='success'>$success</p>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Kata Sandi Baru" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Kata Sandi" required>
            <button type="submit">Reset Kata Sandi</button>
        </form>
        <p>Kembali ke <a href="login.php">Login</a></p>
    </div>
</body>

</html>