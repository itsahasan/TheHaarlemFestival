<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Festival</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">
  <link type="text/css" rel="stylesheet" href="/css/shoppingcartstyle.css">

<style>
    .custom-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 50px 15px rgba(0,0,0,0.1);
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 999 !important;
      }
      .custom-modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        min-width: 400px;
        text-align: center;
    }
    .custom-modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }
    .modal-actions {
        margin-top: 20px;
    }
    .modal-actions button {
        margin: 0 5px;
    }

    .dropdown-item {
    padding: .5rem 1.5rem;
}

    /* Custom Table Styles */
    table {
        width: 100%;
        margin: 10px 0;
    }
    
.navbar>.container, .navbar>.container-fluid {
    display: block !important;
}
.navbar-expand-md .navbar-collapse{
  display: block !important;
}
.navbar-nav{
  justify-content: flex-end;
  padding: 10px 0px;
}

.navbar-expand-md .navbar-nav .nav-link {
    padding-left: 1rem;
}

  /* Menu Styles */
  .nav-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    background-color: #343a40;
  }

  .nav-menu li {
    position: relative;
  }

  .nav-menu li a {
    color: #fff;
    text-decoration: none;
    padding: 0.75rem 1rem;
    display: block;
    font-size: 1rem;
    transition: background-color 0.3s;
  }

  .nav-menu li a:hover {
    background-color: #495057;
  }

  /* Dropdown Styles */
  .navbar .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color:rgb(17, 18, 19) !important;
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: 250px;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }

  .dropdown-menu li a {
    color: #fff;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }

  .dropdown-menu li a:hover {
    background-color: #6c757d;
  }

  .nav-menu li:hover > .dropdown-menu {
    display: block;
  }

  /* Shopping Cart */
  .cart-count {
    display: inline-block;
    background-color: #fff;
    color: #343a40;
    font-weight: bold;
    padding: 0.2rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    margin-left: 0.5rem;
  }

  /* Mobile Styles */
  @media (max-width: 768px) {
    .nav-menu {
      flex-direction: column;
      background-color: #343a40;
    }

    .dropdown-menu {
      position: static;
      background-color: #495057;
      box-shadow: none;
      padding-left: 1rem;
    }

    .nav-menu li:hover > .dropdown-menu {
      display: none;
    }
  }

</style>

  <!-- include jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>

  <script src="/js/toast.js"></script>



  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      // tinymce.init({
      //   selector: 'textarea'
      // });
    </script>

  
  <script>
    $(document).ready(function() {
      $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggle();
      });
    });
  </script>
<script>
    $(function() {


        $('[data-action="edit"], [data-action="delete"]').on('click', function() {
            var action = $(this).data('action');
            var userId = $(this).data('user-id');
            var href = $(this).data('href');


            

            if(action === 'delete') {
                openConfirmModal(action, href);
            }
        });

        function openConfirmModal(action ,href) {
            const modal = $('#confirmModal');
            const modalTitle = $('#modalTitle');
            const modalBody = $('#modalBody');


            modal.show();

            $('#confirmYesBtn').off('click').on('click', function() {
    
                deleteUser( href );

            });

            $('#confirmNoBtn').off('click').on('click', function() {
                // Just hide the modal if "No" is clicked
                modal.hide();
            });
        }

        function deleteUser(href) {
            window.location=href;
        }

      

        $('#modalCloseBtn').click(function() {
            $('#confirmModal').hide();
        });

      });

</script>

</head>

<body>

<!-- Custom Confirmation Modal Structure (Initially Hidden) -->
<div id="confirmModal" class="custom-modal">
    <div class="custom-modal-content border ronded-3 p-5 position-relative">
        <span id="modalCloseBtn" class="custom-modal-close possition-absoluten right-0 top-0">&times;</span>
        <h5 id="modalTitle" class="card-title">Are you sure?</h5>
        <p id="modalBody">Do you want to delete this user?</p>
        <div class="modal-actions">
          <button id="confirmNoBtn" class="btn btn-secondary">No</button>
            <button id="confirmYesBtn" class="btn btn-danger">Yes</button>
        </div>
    </div>
</div>




  <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="z-index:99">
    <div class="container">
      <div class="row no-gutters align-items-center">
        <div class="col-2">
          <a class="navbar-brand" href="/">The Festival</a>
        </div>
        <div class="col-9 text-end d-flex justify-content-end">
          <button class="navbar-toggler ms-auto me-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav-menu">
  <li>
    <a href="/#">Food</a>
    <ul class="dropdown-menu">
      <li><a href="/yummy">Yummy</a></li>
    </ul>
  </li>
  <li>
    <a href="#">History</a>
    <ul class="dropdown-menu">
      <li><a href="/historyevent">Events</a></li>
      <li><a href="/tourguide">TourGuides</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Dance</a>
    <ul class="dropdown-menu">
      <li><a href="/artist/danceartists">Artists</a></li>
      <li><a href="/venue/dancevenues">Venues</a></li>
      <li><a href="/event/danceevents">Events</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Jazz</a>
    <ul class="dropdown-menu">
      <li><a href="/artist/jazzartists">Artists</a></li>
      <li><a href="/venue/jazzvenues">Venues</a></li>
      <li><a href="/event/jazzevents">Events</a></li>
    </ul>
  </li>

  <?php
  if (!isset($_SESSION['loggedin'])) {
  ?>
    <li>
      <a href="/login/" class="text-white">Sign In</a>
    </li>
  <?php
  }
  ?>
  <?php if (isset($_SESSION['loggedin'])) { ?>
    <li>
      <a href="#">Profile</a>
      <ul class="dropdown-menu">
        <li><a href="/profile/view">Edit Profile</a></li>
        <li><a href="/orders/myorders">My Orders</a></li>
        <li><a href="/login/logout">Logout</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) { ?>
          <li><a href="/api/keys">API</a></li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>

  <?php
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
  ?>
      <li>
        <a href="#">CMS</a>
        <ul class="dropdown-menu">
          <li><a href="/admin/user">Users</a></li>
          <li><a href="/admin/artist/list">Artists (jazz and dance) CMS</a></li>
          <li><a href="/admin/venue/list">Venues (jazz and dance) CMS</a></li>
          <li><a href="/admin/event/list">Events (jazz and dance) CMS</a></li>
          <li><a href="/admin/tourguide/list">Tour Guide CMS</a></li>
          <li><a href="/admin/historyevent/cms">History Events CMS</a></li>
          <li><a href="/admin/orders/list">Orders CMS</a></li>
          <li><a href="/admin/yummy/manageSessions">Sessions</a></li>
          <li><a href="/admin/yummy/manageRestaurants">Restaurants</a></li>
          <li><a href="/admin/yummy/manageReservations">Reservations</a></li>
        </ul>
      </li>
  <?php
    } else if ($_SESSION['role'] == 3) {
  ?>
      <li>
        <a href="#">QR</a>
        <ul class="dropdown-menu">
          <li><a href="/qr">Scan QR</a></li>
        </ul>
      </li>
  <?php
    }
  }
  ?>

  <li>
    <a href="/shoppingcart" class="text-white">
      <i class="fas fa-shopping-cart"></i>
      <?php
      if (isset($_SESSION['cartcount'])) {
        echo "<span id='card_count' class='cart-count'>{$_SESSION['cartcount']}</span>";
      } else {
        echo "<span id='card_count' class='cart-count'>0</span>";
      }
      ?>
    </a>
  </li>
</ul>


          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">