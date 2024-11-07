<?php  include("./includes/connect.php");
include("./functions/common_function.php");
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/ all.min.css" integrity="sha512-9usAa1@IRO@HhonpyAIVpjrylPvoDwi PUiKdWk5t3PyolY1c0d4DSE@Ga +ri4AuTroPR5aQvXU9xC6q0PnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Login </h2>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-x1-5">
      <img src="./images/admin_login.jpg" alt="Admin Registration"
      class="img-fluid">
    </div>
    <div class="col-lg-6 col-x1-4">
      <form action="" method="post">
        <div class="form-outline mb-4">
          <label for="username" class="form-label">Username</label> 
          <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
        </div>
        <div class="form-outline mb-4">
        <label for="password" class="form-label">Password</label> 
        <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
        </div>
                
        <div>
          <input type="submit" class="bg-info py-2 px-3 border-8" name="admin_login" value="Login">
          <p class="small">Don't have an account? <a href="admin_registration.php">Register</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>


<?php
  if(isset($_POST['admin_login']))
  {
    $user_username=$_POST['username']; 
    $user_password=$_POST['password'];
   
    $select_query="SELECT * FROM `admin_seller` where admin_name='$user_username'";
    $result=mysqli_query($con,$select_query); 
    $row_count=mysqli_num_rows($result); 
    $row_data=mysqli_fetch_assoc($result);


      if ($user_password == $row_data['admin_pd'])
      { 
        echo "<script>alert('Login successful')</script>";
        echo "<script>window.open('admin-dashboard.php', '_self')</script>";
        }
      else{
        echo "<script>alert('Invalid Credentials')</script>";
        echo "<script>window.open('admin_login.php', '_self')</script>";
      }
   }




?>
