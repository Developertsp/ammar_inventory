<?php
error_reporting(E_ALL & ~E_NOTICE); 
session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['user_role'])) {
  header("Location: index.php");
  exit();

}
?>
<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Ammars Fragrances</title>
  <meta name="description"
    content="A dashboard implementation that mainly has visual items such as banners, call to action buttons and stats." />
  <!-- Favicon Tags Start -->
  <link rel="icon" type="image/png" href="img/favicon/faviconammar.ico" sizes="32x32" />

  <meta name="application-name" content="&nbsp;" />
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
  <!-- Favicon Tags End -->
  <!-- Font Tags Start -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="font/CS-Interface/style.css" />
  <!-- Font Tags End -->
  <!-- Vendor Styles Start -->
  <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
  <link rel="stylesheet" href="css/vendor/OverlayScrollbars.min.css" />

  <!-- Vendor Styles End -->
  <!-- Template Base Styles Start -->
  <link rel="stylesheet" href="css/styles.css" />
  <!-- Template Base Styles End -->

  <link rel="stylesheet" href="css/main.css" />
  <script src="js/base/loader.js"></script>


</head>

<body>
  <div id="root">
    <div id="nav" class="nav-container d-flex">
      <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
          <a href="store-admin.php">
            <!-- Logo can be added directly -->
            <img src="img/logo/Tech-White-Logo.svg" alt="logo" />

            <!-- Or added via css to provide different ones for different color themes -->

          </a>
        </div>
        <!-- Logo End -->



        <!-- User Menu Start -->
        <div class="user-container d-flex">
          <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <img class="profile" alt="profile" src="<?= $_SESSION['user']['userImage'] ?? '' ?>" />
            <div class="name">
              <?= $_SESSION['user']['name'] ?? '' ?>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end user-menu wide">
            <div class="row mb-1 ms-0 me-0">
              <div class="col-12 p-1 mb-3 pt-3">
                <div class="separator-light"></div>
              </div>
              <div class="col-6 ps-1 pe-1">
                <ul class="list-unstyled">
                  <li>
                    <a href="#">
                      <i data-acorn-icon="help" class="me-2" data-acorn-size="17"></i>
                      <span class="align-middle">Help</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i data-acorn-icon="file-text" class="me-2" data-acorn-size="17"></i>
                      <span class="align-middle">Docs</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-6 pe-1 ps-1">
                <ul class="list-unstyled">
                  <li>
                    <a href="#">
                      <i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <a href="logout.php">
                      <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                      <span class="align-middle">Logout</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
          <li class="list-inline-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
              <i data-acorn-icon="search" data-acorn-size="18"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" id="pinButton" class="pin-button">
              <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
              <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" id="colorButton">
              <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
              <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true"
              aria-expanded="false" class="notification-button">
              <div class="position-relative d-inline-flex">
                <i data-acorn-icon="bell" data-acorn-size="18"></i>
                <span class="position-absolute notification-dot rounded-xl"></span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">
              <div class="scroll">
                <ul class="list-unstyled border-last-none">
                  <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                    <img src="img/profile/profile-1.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                      alt="..." />
                    <div class="align-self-center">
                      <a href="#">Joisse Kaycee just sent a new comment!</a>
                    </div>
                  </li>
                  <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                    <img src="img/profile/profile-2.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                      alt="..." />
                    <div class="align-self-center">
                      <a href="#">New order received! It is total $147,20.</a>
                    </div>
                  </li>
                  <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                    <img src="img/profile/profile-3.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                      alt="..." />
                    <div class="align-self-center">
                      <a href="#">3 items just added to wish list by a user!</a>
                    </div>
                  </li>
                  <li class="pb-3 pb-3 border-bottom border-separator-light d-flex">
                    <img src="img/profile/profile-6.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                      alt="..." />
                    <div class="align-self-center">
                      <a href="#">Kirby Peters just sent a new message!</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
          <ul id="menu" class="menu">
            <?php
            if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
              if ($_SESSION['user_role'] == 'admin') {
                ?>

                <li>
                  <a href="store-admin.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Dashboards</span>
                  </a>
                </li>

                <li>
                  <a href="order-manage.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Orders</span>
                  </a>
                </li>

                <li>
                  <a href="category.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Category</span>
                  </a>
                </li>

                <li>
                  <a href="products.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Products</span>
                  </a>
                </li>

                <li>
                  <a href="users.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Users</span>
                  </a>
                </li>

                <?php
              } else { ?>

                <li>
                  <a href="store-admin.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Dashboards</span>
                  </a>
                </li>
                <li>
                  <a href="order-manage.php">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Orders</span>
                  </a>
                </li>
              <?php
              }
            }
            ?>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
          <!-- Scrollspy Mobile Button Start -->
          <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
            <i data-acorn-icon="menu-dropdown"></i>
          </a>
          <!-- Scrollspy Mobile Button End -->

          <!-- Scrollspy Mobile Dropdown Start -->
          <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
          <!-- Scrollspy Mobile Dropdown End -->

          <!-- Menu Button Start -->
          <a href="#" id="mobileMenuButton" class="menu-button">
            <i data-acorn-icon="menu"></i>
          </a>
          <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
      </div>
      <div class="nav-shadow"></div>
    </div>
    <?php
    require_once('JS.php');
    require_once('functions.php');
    ?>