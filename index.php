<?php
  include('includes\connect.php');
  include('functions\common_function.php');
  session_start();
?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Ecommerce Website using PHP and MySQL.</title>
    
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <!-- fonts google  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700&family=Outfit:wght@200;300;600&family=Rubik+Mono+One&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      .card-img-top 
      {
        height: 200px; 
        object-fit: cover;
      }
      .image-logo{

        width: 15%;
      }
      .nav-bar-class{
        padding: 1px;
        padding-left: 0px;
        
      }
      body{
        /* font-family: 'Gabarito', sans-serif; */
        font-family: 'Outfit', sans-serif;
        /* font-family: 'Rubik', sans-serif;
        font-family: 'Rubik Mono One', monospace; */
      }
      .text-heading{
        font-weight: 600;
      }
      .text-heading2{
        font-weight: 500;
      }
      .nav-heading{
        font-size: 28px;
        padding-right: 10px;
      }

      .nav-pad{
        padding-left: 10px;
      }
      .navbar-nav .nav-item {
        margin-right: 10px; 
        font-size: 20px;
      }
      .navbar-2{
        background-color: #d9d9d9;
      }
    </style>
</head>

  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-bar-class">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="brushes to pixels.png" alt="Logo" class="navbar-brand image-logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item nav-pad">
              <a class="nav-link active nav-heading " aria-current="page" href="index.php">Home</a>
            </li>
            <?php
             if(isset($_SESSION['username'])){
              echo"
              <li class='nav-item nav-pad'>
              <a class='nav-link nav-heading' href='./user_area/profile.php'>My Account</a>
            </li>";
             }else{
              echo"<li class='nav-item nav-pad'>
              <a class='nav-link nav-heading ' href='./user_area/user_registration.php'>Register</a>
            </li>";

             }
            ?>
      
            <li class="nav-item nav-pad">
              <a class="nav-link nav-heading" href="cart.php">Go to Cart </a>
            </li>
            <li class="nav-item nav-pad">
              <a class="nav-link nav-heading" href="#">Total price <?php   totalPriceCart()?>  </a>
            </li>
          </ul> 


          <form class="d-flex" action="search_products.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" name="search_data_products">
          </form>
        </div>
      </div>
    </nav>
    <?php
      cartAdd();
    ?>
    <!-- below navbar  -->
    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary navbar-2">
  <ul class="navbar-nav me-auto">
    <?php
    if (!isset($_SESSION['username'])) {
      echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome Guest</a>
      </li>";
      echo "<li class='nav-item'>
        <a class='nav-link' href='./user_area/user_login.php'>Login</a>
      </li>";
    } else {
      echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . " </a>
      </li>";
      echo "<li class='nav-item'>
        <a class='nav-link' href='./user_area/logout.php'>Logout</a>
      </li>";
    }
    ?>
  </ul>
</nav>

    <!-- third child -->
    <div class="bg-light">
      <h3 class="text-center text-heading">Brushes to Pixels</h3>
      <p class="text-center text-heading2">Inspire. Create. Decorate.</p>
    </div>


    <!-- fourth child -->
    <div class="row">
      <div class="col-md-10">
      <!-- products -->
        <div class="row">

        <?php
          getProducts();
          GetCategory();

          // $ip = getIPAddress();  
          // echo 'User Real IP Address - '.$ip;  
        ?>
         
          <!-- row end  -->
        </div>
          <!-- col end  -->
      </div>
          
      <div class="col-md-2 bg-secondary">
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
          </li>
          <?php

            Showcategoreis()
            
          ?>
        </ul>
      </div>
    </div>
  </body>
</html>