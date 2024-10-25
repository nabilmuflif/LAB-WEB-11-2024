<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error_message)) : ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>
    <form method="POST" action="" class="register-form">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" required> Laki-laki</label>
                <label><input type="radio" name="gender" value="Female" required> Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label>Fakultas:</label>
            <input type="text" name="faculty" required>
        </div>
        <div class="form-group">
            <label>Angkatan:</label>
            <input type="text" name="batch" required>
        </div>
        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>
    <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
</body>
</html>

