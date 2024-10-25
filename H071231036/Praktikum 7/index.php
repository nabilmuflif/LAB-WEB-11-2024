<?php
include './db/config.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'admin') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, nim=?, prodi=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $nim, $prodi, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $nim, $prodi);
    }

    $stmt->execute();
    header('Location: index.php');
    exit;
}

if (isset($_GET['delete']) && $role === 'admin') {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: index.php');
    exit;
}

$mahasiswa = $conn->query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Index</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Mahasiswa</h2>
        <p>Login sebagai: <?= $username ?> (<?= $role ?>)</p>
        <?php if ($role === 'admin'): ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" name="nim" required>
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" name="prodi" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
            </form>
        <?php endif; ?>
        
        <h3 class="mt-5">Daftar Mahasiswa</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <?php if ($role === 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $mahasiswa->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['prodi'] ?></td>
                        <?php if ($role === 'admin'): ?>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    </body>
  </html>
