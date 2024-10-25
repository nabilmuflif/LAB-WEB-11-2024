<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$logged_in_user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Dashboard</h2>
    <p>Selamat datang, <?= htmlspecialchars($logged_in_user['name']) ?>!</p>

    <?php if ($logged_in_user['username'] === 'adminxxx') : ?>
        <h3>Data Semua User:</h3>
        <table>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($_SESSION['users'] as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= isset($user['gender']) ? htmlspecialchars($user['gender']) : '-' ?></td>
                    <td><?= isset($user['faculty']) ? htmlspecialchars($user['faculty']) : '-' ?></td>
                    <td><?= isset($user['batch']) ? htmlspecialchars($user['batch']) : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <h3>Data Anda:</h3>
        <table>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($logged_in_user['email']) ?></td>
                <td><?= htmlspecialchars($logged_in_user['username']) ?></td>
                <td><?= htmlspecialchars($logged_in_user['name']) ?></td>
                <td><?= isset($logged_in_user['gender']) ? htmlspecialchars($logged_in_user['gender']) : '-' ?></td>
                <td><?= isset($logged_in_user['faculty']) ? htmlspecialchars($logged_in_user['faculty']) : '-' ?></td>
                <td><?= isset($logged_in_user['batch']) ? htmlspecialchars($logged_in_user['batch']) : '-' ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</body>
</html>
