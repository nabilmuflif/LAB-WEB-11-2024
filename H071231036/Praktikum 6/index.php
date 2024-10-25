<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        [
            'email' => 'admin@gmail.com',
            'username' => 'adminxxx',
            'name' => 'Admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ],
        [
            'email' => 'nanda@gmail.com',
            'username' => 'nanda_aja',
            'name' => 'Wd. Ananda Lesmono',
            'password' => password_hash('nanda123', PASSWORD_DEFAULT),
            'gender' => 'Female',
            'faculty' => 'MIPA',
            'batch' => '2021',
        ],
        [
            'email' => 'arif@gmail.com',
            'username' => 'arif_nich',
            'name' => 'Muhammad Arief',
            'password' => password_hash('arief123', PASSWORD_DEFAULT),
            'gender' => 'Male',
            'faculty' => 'Hukum',
            'batch' => '2021',
        ],
    ];
}

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_email_or_username = $_POST['email_or_username'];
    $input_password = $_POST['password'];

    foreach ($_SESSION['users'] as $user) {
        if (
            ($input_email_or_username === $user['email'] || $input_email_or_username === $user['username']) &&
            password_verify($input_password, $user['password'])
        ) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        }
    }
    $error_message = "Email/Username atau Password salah.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error_message)) : ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Email/Username:</label>
        <input type="text" name="email_or_username" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>
</html>
