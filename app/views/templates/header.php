<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($payload['title']) ? $payload['title'] : '' ?></title>
  <?php
    require_once __DIR__ . '/styles.php';

    use App\Controllers\Login;

    $user_login = Login::userIsLogin(); 

  ?>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/mahasiswa">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
          <?php if($user_login): ?>
            <a class="nav-link" href="/logout">Logout</a>
          <?php else: ?>
            <a class="nav-link" href="/login">Login</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- body of view start here -->
