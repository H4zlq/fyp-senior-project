<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A.I Code Converter - <?= $data['title'] ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="<?= BASE_URL ?>/assets/js/checkout.js" defer></script>
  <script src="<?= BASE_URL ?>/assets/js/modal.js" defer></script>
  <script src="<?= BASE_URL ?>/assets/js/notification.js" defer></script>
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <img src="<?= BASE_URL ?>/assets/img/logo.png" alt="A.I Code Converter">
      </div>
      <ul class="nav-links">
        <li><a href="<?= BASE_URL ?>/home">Home</a></li>
        <li><a href="<?= BASE_URL ?>/subscription">Subscription</a></li>
        <li><a href="<?= BASE_URL ?>/converter">Converter</a></li>
        <li><a href="<?= BASE_URL ?>/forum">Forum</a></li>
        <?php if (Session::exists('loggedin') || Session::get('loggedin')) : ?>
          <?php if (Session::get('role') === 'admin') : ?>
            <li></li>
            <li></li>
            <li>
              <div class="notification">
                <i class="fas fa-bell fa-2x"></i>
                <span class="notification" id="notification-badge"></span>
                <div class="notification-content">
                  <div class="notification-header">
                    <h3>Notification</h3>
                  </div>
                  <div class="notification-body"></div>
                </div>
              </div>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="nav-links">
        <li class="dropdown">
          <i class="fas fa-user-circle fa-2x"></i>
          <div class="dropdown-content">
            <?php if (Session::exists('loggedin') || Session::get('loggedin') === true) : ?>
              <?php if (Session::get('role') === 'admin') : ?>
                <a href="<?= ADMIN_BASE_URL ?>/dashboard">Admin</a>
              <?php endif; ?>
              <a href="<?= BASE_URL ?>/profile">Profile</a>
              <a href="<?= BASE_URL ?>/logout">Logout</a>
            <?php else : ?>
              <a href="<?= BASE_URL ?>/login">Login</a>
              <a href="<?= BASE_URL ?>/signup">Signup</a>
            <?php endif; ?>
          </div>
        </li>
      </ul>
    </nav>
    <div class=" menu-icon" onclick="toggleMenu()">
      <i class="fas fa-bars"></i>
    </div>
  </header>