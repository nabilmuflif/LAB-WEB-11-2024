<?php
session_start();
include 'db/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header('Location: home.php');
            exit();
        } else {
            echo "Password salah";
        }
    } else {
        echo "Username tidak ditemukan";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c2c2c; /* Abu-abu gelap */
        }
        .h-custom-2 {
            height: calc(100% - 50px);
        }
        .form-control {
            background-color: #333;
            color: #fff;
        }
        .form-control:focus {
            background-color: #333;
            color: #fff;
        }
        .form-label {
            color: #fff;
        }
        .btn-info {
            background-color: #017bff;
            border: none;
        }
        .btn-info:hover {
            background-color: #0156b3;
        }
        .text-muted {
            color: #d1d1d1 !important;
        }
        .link-info {
            color: #017bff;
        }
        .link-info:hover {
            color: #0156b3;
        }
    </style>

</head>
<body>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-white">

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form method="POST" style="width: 23rem;">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="username" name="username" class="form-control form-control-lg" required/>
              <label class="form-label" for="username">Username</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
              <label class="form-label" for="password">Password</label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
            </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
            <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>
          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="assest/img2.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
</body>
</html>