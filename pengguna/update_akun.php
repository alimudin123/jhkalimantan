<?php
session_start();
require 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}

// Ambil data pengguna dari database
$stmt = $pdo->prepare("SELECT * FROM user_login WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$userLoginData = $stmt->fetch(PDO::FETCH_ASSOC);

// Cek apakah data pengguna ditemukan
if (!$userLoginData) {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $errors = [];

    // Validasi input
    if (empty($username) || empty($email) || empty($phone) || empty($address)) {
        $errors[] = "Semua kolom harus diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Jika tidak ada error, lakukan update
    if (empty($errors)) {
        try {
            // Update data pengguna di database
            $stmt = $pdo->prepare("UPDATE user_login SET phone = :phone, address = :address WHERE id = :id");
            $stmt->execute(['phone' => $phone, 'address' => $address, 'id' => $_SESSION['user_id']]);

            // Redirect ke halaman akun dengan pesan sukses
            $_SESSION['success'] = "Informasi profil berhasil diperbarui.";
            header("Location: user_akun.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Terjadi kesalahan saat memperbarui profil: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        h1,
        h2 {
            color: rgb(0, 0, 0);
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 20px;
            border-bottom: 2px solidrgb(0, 0, 0);
            padding-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #FFBDBD;
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #FFBDBD;
            color: black;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: rgb(7, 109, 212);
            text-decoration: none;
            text-decoration: underline;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        li:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Profil</h1>

        <?php if (!empty($errors)): ?>
            <div>
                <h3>Kesalahan:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="update_akun.php" method="POST">
            <input type="text" name="username" placeholder="Nama Pengguna" value="<?php echo htmlspecialchars($userLoginData['username']); ?>" disabled>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($userLoginData['email']); ?>" disabled>
            <input type="text" name="phone" placeholder="Nomor Telepon" value="<?php echo htmlspecialchars($userLoginData['phone']); ?>" required>
            <input type="text" name="address" placeholder="Alamat" value="<?php echo htmlspecialchars($userLoginData['address']); ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="user_akun.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>