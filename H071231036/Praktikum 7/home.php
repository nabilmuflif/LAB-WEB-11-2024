<?php
session_start();
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>University</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #A51C30">
        <div class="container">
            <a class="navbar-brand" href="home.php">Bridgeton University</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                  <a class="nav-link disabled" href="#" aria-disabled="true">|</a>
                </li>
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Data Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout (<?= $_SESSION['username'] ?>)</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-image text-white text-center py-5" style="background-color: #007bff;">
        <div class="container">
        <h1 class="display-4">Join Us!</h1>
        <p class="lead">We are a forward-thinking institution dedicated to nurturing the next generation of leaders. Join us and gain access to a dynamic learning environment, cutting-edge resources, and opportunities for real-world experience that will prepare you to excel in your future career</p>
        <button type="button" class="btn btn-light" onclick="window.location.href='register.php'">Register Now</button>
</div>
    </div>

    <footer class="bg-dark text-light pt-4">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <h5>Contact Us</h5>
              <ul class="list-unstyled">
                <li>Email: Bridgeton University</li>
                <li>Phone: +123 456 789</li>
                <li>Address: California</li>
              </ul>
            </div>
            <div class="col-md-4">
              <h5>Follow Us</h5>
              <ul class="list-unstyled d-flex">
                <li class="me-3"><a href="#" class="text-light"><i class="bi bi-facebook"></i> Facebook</a></li>
                <li class="me-3"><a href="#" class="text-light"><i class="bi bi-twitter"></i> Twitter</a></li>
                <li><a href="#" class="text-light"><i class="bi bi-instagram"></i> Instagram</a></li>
              </ul>
            </div>
            <div class="col-md-4 text-md-end">
              <p>&copy; 2024 Bridgeton. All rights reserved.</p>
            </div>
          </div>
        </div>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    </body>
  </html>