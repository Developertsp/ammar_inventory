<?php
include('connection.php');
session_start();
$errors = NULL;

// Check if the user is logged in and has the appropriate role
if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
  if ($_SESSION['user_role'] == 'admin') {
    header("Location: store-admin.php");
    exit();
  } else {
    header("Location: orders.php");
    exit();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($db, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = $row;
      $_SESSION['user_role'] = $row['role'];
      if ($row['role'] == 'admin') {
        header("Location: store-admin.php");
        exit();
      } else {
        header("Location: order-manage.php");
        exit();
      }
    } else {
      $errors = "Invalid email or password.";
    }
  }
  //else {
  //     echo "Query failed: " . mysqli_error($db);
  // }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Ammars Fragrances</title>
  <meta name="description" content="Login Page" />
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
  <style>
    .my-logo img {
      width: 200px;
      /* min-height: 35px; */
      object-position: left;
      object-fit: cover;
      background-repeat: no-repeat;
      /* background-image: url('uploads/main-logo.png') !important; */
    }
  </style>
</head>

<body class="h-100">
  <div id="root" class="h-100">
    <!-- Background Start -->
    <div class="fixed-background"></div>
    <!-- Background End -->

    <div class="container-fluid p-0 h-100 position-relative">
      <div class="row g-0 h-100">
        <!-- Left Side Start -->
        <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
          <div class="min-h-100 d-flex align-items-center">
            <div class="w-100 w-lg-75 w-xxl-50">
              <div>
                <div class="mb-5">
                  <h1 class="display-3 text-white">Ammar's Fragrances </h1>
                  <h1 class="display-3 text-white">Inventory Management</h1>
                </div>
                <p class="h6 text-white lh-1-5 mb-5">
                  Welcome to Ammar's Fragrances Inventory management software, please use the logins provied
                </p>
                <div class="mb-5">
                  <a class="btn btn-lg btn-outline-white" href="https://techsolutionspro.co.uk/contact-us/"
                    target="b">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Left Side End -->

        <!-- Right Side Start -->
        <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
          <div
            class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
            <div class="sw-lg-50 px-5">
              <div class="sh-11">
                <a href="index.html">
                  <div class="my-logo">
                    <img src="uploads/main-logo.svg" alt="">
                  </div>
                </a>
              </div>
              <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">Welcome,</h2>
                <h2 class="cta-1 text-primary">let's get started!</h2>
              </div>
              <div class="mb-5">
                <p class="h6">Please use your credentials to login.</p>
                <p class="h6">
                  Ring me on
                  <a href="tel:01159902782">0115 990 2782</a>
                </p>
              </div>
              <div>
                <form action="index.php" method="post" class="tooltip-end-bottom" novalidate>
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="email"></i>
                    <input id="email" type="email" required="" class="form-control" placeholder="Email" name="email"
                      value="<?= $_POST["email"] ?? '' ?>" />
                  </div>
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input class="form-control pe-7" required="" name="password" id="password" type="password"
                      placeholder="Password" />
                    <a class="text-small position-absolute t-3 e-3"
                      href="Pages.Authentication.ForgotPassword.html">Forgot?</a>
                  </div>
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <?php if ($errors): ?>
                      <span class="text-danger "> *
                        <?= $errors ?>
                      </span>
                    </div>
                  <?php endif; ?>
                  <button type="submit" class="btn btn-lg btn-primary">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Right Side End -->
      </div>
    </div>
  </div>
  </div>


  <?php include('footer.php') ?>