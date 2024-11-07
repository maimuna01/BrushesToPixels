<?php  
include("./includes/connect.php");
include("./functions/common_function.php") ?>

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
    <h2 class="text-center mb-5">Admin Registration </h2>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-x1-5">
      <img src="./images/admin_reg.jpg" alt="Admin Registration"
      class="img-fluid">
    </div>
    <div class="col-lg-6 col-x1-4">
      <form action="" method="post">
        <div class="form-outline mb-4">
          <label for="username" class="form-label">Username</label> 
          <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
        </div>
        <div class="form-outline mb-4">
          <label for="email" class="form-label"> Email</label> 
          <input type="email" id="email" name="email" placeholder="Enter your email" required="required" class="form-control">
        </div>
        <div class="form-outline mb-4">
        <label for="password" class="form-label">Pasword</label> 
        <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
        </div>
                
        <div class="form-outline mb-4">
          <label for="confirm_password" class="form-label"> Confirm Pasword</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your confirm_password" required="required" class="form-control">
        </div>
        <div>
          <input type="submit" class="bg-info py-2 px-3 border-8" name="admin_reg" value="Register">
          <p class="small">Have an account? <a href="admin_login.php">Login</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<?php
  if(isset($_POST['admin_reg']))
  {
    $user_username=$_POST['username'];
    $user_email=$_POST['email'];
    $user_password=$_POST['password'];
    $conf_user_password=$_POST['confirm_password'];
 
    
    // select query 
    $select_query="SELECT * FROM `admin_seller` where admiin_email='$user_email'";
    $result=mysqli_query($con, $select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
      echo "<script>alert('Email already exists')</script>";
    }
    else if($user_password!=$conf_user_password){
      echo "<script>alert('Password doesnt match')</script>";
   
    }
    else{
      // insert_query
      $insert_query="INSERT INTO `admin_seller` (admin_name, admiin_email, admin_pd) 
      values ('$user_username', '$user_email', '$user_password')";
      
      $sql_execute=mysqli_query($con, $insert_query);
      if ($sql_execute){
        echo "<script>alert('Data inserted successfully')</script>";
        echo "<script>window.open('admin-dashboard.php' , '_self')</script>";
      }else{
        die(mysqli_error($con));
      }

    }
    // selecting cart items 
   
  }


?>



