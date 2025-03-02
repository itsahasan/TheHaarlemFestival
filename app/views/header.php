<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Festival</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

  <!-- include jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link type="text/css" rel="stylesheet" href="/css/shoppingcartstyle.css">
  <script>
    $(document).ready(function() {
      $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggle();
      });
    });
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="/">The Festival</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="/food" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Food
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/yummy">Yummy</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              History
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/historyevent">Events</a>
              <a class="dropdown-item" href="/tourguide">TourGuides</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dance
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/artist/danceartists">Artists</a>
              <a class="dropdown-item" href="/venue/dancevenues">Venues</a>
              <a class="dropdown-item" href="/event/danceevents">Events</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Jazz
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/artist/jazzartists">Artists</a>
              <a class="dropdown-item" href="/venue/jazzvenues">Venues</a>
              <a class="dropdown-item" href="/event/jazzevents">Events</a>
            </div>
          </div>

          <?php
          if (!isset($_SESSION['loggedin'])) {
          ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="/login/">Sign In</a>
            </li>

          <?php
          }
          ?>
          <?php if (isset($_SESSION['loggedin'])) { ?>
            <div class="dropdown show">
              <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/user/profile">Edit Profile</a>
                <a class="dropdown-item" href="/orders/myorders">My Orders</a>
                <a class="dropdown-item" href="/login/logout">Logout</a>
                <?php
                  }
                ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) { ?>
                <a class="dropdown-item" href="/api/keys">API</a>
                <?php } ?>
              </div>
          </div>

          <li class="nav-item">
            <a class="nav-link text-white" href="/shoppingcart">
              <i class="fas fa-shopping-cart"></i>
              <?php
              if (isset($_SESSION['cartcount'])) {
                echo "<span id='card_count' class='text-dark bg-light fw-bold'>{$_SESSION['cartcount']}</span>";
              } else {
                echo "<span id='card_count' class='text-dark bg-light fw-bold'>0</span>";
              }
              ?>
            </a>
          </li>

          <!-- this should be available only for ADMIN -->
          <?php
          if (isset($_SESSION['role'])) {

            if ($_SESSION['role'] == 1) {
          ?>
              <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  CMS
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="/user">Users</a>
                  <a class="dropdown-item" href="/artist/artistcms">Artists (jazz and dance) CMS</a>
                  <a class="dropdown-item" href="/venue/venuecms">Venues (jazz and dance) CMS</a>
                  <a class="dropdown-item" href="/event/eventcms">Events (jazz and dance) CMS</a>
                  <a class="dropdown-item" href="/tourguide/cms">Tour Guide CMS</a>
                  <a class="dropdown-item" href="/historyevent/cms">History Events CMS</a>
                  <a class="dropdown-item" href="/orders/cms">Orders CMS</a>
                  <a class="dropdown-item" href="/yummy/manageSessions">Sessions</a>
                  <a class="dropdown-item" href="/yummy/manageRestaurants">Restaurants</a>
                  <a class="dropdown-item" href="/yummy/manageReservations">Reservations</a>
                </div>
              </div>
              <!-- end admin -->

              <!-- this should be available only for EMPLOYEE -->
            <?php
            } else if ($_SESSION['role'] == 3) {
            ?>
              <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  QR
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="/qr">Scan QR</a>
                </div>
              </div>
          <?php
            }
          }
          ?>
          <!-- end employee -->

        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">