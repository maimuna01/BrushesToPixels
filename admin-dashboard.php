<?php
  include('./includes\connect.php');
  include('./functions\common_function.php');
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
 
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- fonts google  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700&family=Outfit:wght@200;300;600&family=Rubik+Mono+One&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="admin-dasboard.css" />
    <style>
      body {
      font-family: 'Outfit', sans-serif;
    }
    .image-logo {
      width: 5%;
      height: 5%;
      padding-left: 10px;
    }
    .nav-bar-class {
      padding: 1px;
      padding-left: 0px;
    }
    .text-heading {
      font-weight: 600;
    }
    .text-heading2 {
      font-weight: 500;
    }
    .nav-heading {
      font-size: 28px;
      padding-right: 10px;
    }
    .nav-pad {
      padding-left: 10px;
    }
    .navbar-nav .nav-item {
      margin-right: 10px;
      font-size: 20px;
    }
    .navbar-2 {
      background-color: #d9d9d9;
    }

      /* color last  */
       .bg-body-tertiary {
        background-color: #9a9a9a;
      }

      /* Change pink to light gray */
      .bg-info {
        background-color: #f2f2f2;
      }

      /* Change text color for the buttons */
      .bg-info a {
        color: #333333;
      }

      /* Change the border color for the logout button */
      .logout-button .bg-info {
        border-color: #333333;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary nav-bar-class">
    <img src="brushes to pixels.png" alt="Logo" class="navbar-brand image-logo text-center" />
    <div class="headline text-center">
      <h1 class="text-center">Manage Details</h1>
    </div>
  </nav>

    <section class="section">
      <div class="container">
        <div class="row">

          <div class="col-md-9">
            <div class="button-div">
              <button>
                <a href="admin-dashboard.php?insert_categories"
                  >Insert Categories</a
                >
              </button>
              <button><a href="admin-dashboard.php?view_categories">View Categories</a></button>
              <button><a href="insert_product.php">Insert Products</a></button>
              <button><a href="admin-dashboard.php?view_products">View Products</a></button>
              <button><a href="admin-dashboard.php?all_orders">All orders </a></button>

            </div>
          </div>
        </div>
        <div class="container">
          <?php
          if(isset($_GET['insert_categories'])){
            include('insert_categories.php');
          }
          if(isset($_GET['view_products'])){
            include('view_products.php');
          }
    
          if(isset($_GET['edit_products'])){
            include('edit_products.php');
          }
          if(isset($_GET['delete_product'])){
            include('delete_product.php');
          }
          if(isset($_GET['view_categories'])){
            include('view_categories.php');
          }
          if(isset($_GET['edit_category'])){
            include('edit_category.php');
          }
          if(isset($_GET['delete_category'])){
            include('delete_category.php');
          }
          if(isset($_GET['all_orders'])){
            include('all_orders.php');
          }
          if(isset($_GET['delete_order'])){
            include('delete_order.php');
          }
          ?>
  
        </div>
      </div>
    </section>
    <form action="" method="post">
      <div class="logout-button">
      <div>
            <input type="submit" class="bg-info py-2 px-3 border-8" name="admin_logout" value="LOGOUT">
          </div>
      </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>



<?php
  if(isset($_POST['admin_logout']))
  {
    echo " hi";
    
    echo "<script>alert('Loged out successfully')</script>";
    echo "<script>window.open('admin_login.php', '_self')</script>";
  }



?>
