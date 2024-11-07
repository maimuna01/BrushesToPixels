<?php
  include('..\includes\connect.php');
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
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/ all.min.css" integrity="sha512-9usAa1@IRO@HhonpyAIVpjrylPvoDwi PUiKdWk5t3PyolY1c0d4DSE@Ga +ri4AuTroPR5aQvXU9xC6q0PnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <style>
      .card-img-top 
      {
        height: 200px; 
        object-fit: cover;
      }
    </style>
</head>

  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul> 

         
        </div>
      </div>
    </nav>
   
    <!-- below navbar  -->
    <!-- second child -->
    <nav class="navbar navbar-expand-1g navbar-dark bg-secondary"> 
      <ul class="navbar-nav me-auto">
        
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']." </a>
          </li>";
        }

        
        if(!isset($_SESSION['username'])){
          echo " <l1 l1 class='nav-item'>
          <a class='nav-link' href='./user_login.php'>Login</a>
          </l1>";
        }else{
          echo " <li class='nav-item'>
          <a class='nav-link' href='logout.php'>Logout</a>
          </li>";
        }
        
        ?>
        
      </ul>
    </nav>

    <!-- third child -->
    <div class="bg-light">
      <h3 class="text-center">Hidden Store</h3>
      <p class="text-center">Communications is at the heart of e-commerce and community</p>
    </div>


    <!-- fourth child -->
    <div class="row">
      <div class="col-md-12">
      <!-- products -->
        <div class="row">
          <?php
          if(!isset($_SESSION['username'])){
            include ('user_login.php');
          }
          else{
            include('payment.php');
          }
          ?>
          <!-- row end  -->
        </div>
          <!-- col end  -->
      </div>
          
      
    </div>
  </body>
</html>