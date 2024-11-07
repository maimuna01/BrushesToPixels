<?php  include("../includes/connect.php");
include("../functions/common_function.php");
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
 
   <style> body{
    overflow-x:hidden;
   }</style>

</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">User Login </h2> 
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post" >
          
          <!-- Username  -->
          <div class="form-outline mb-4">
            <label for="user_username" class="form-label">Username</label> 
            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" 
            autocomplete="off" required="required" name="user_username"/>
          </div>
          <!-- password field  -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label> 
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password " 
                  autocomplete="off" required="required" name="user_password"/>
          </div>
          
          <div class="text-center">
            <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name ="user_login">
            <p>Dont have an account ? <a href="user_registration.php">Register</a></p>
          
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<?php
  if(isset($_POST['user_login']))
  {
    $user_username=$_POST['user_username']; 
    $user_password=$_POST['user_password'];
   
    $select_query="SELECT * FROM `user_buyer` where user_name='$user_username'";
    $result=mysqli_query($con,$select_query); 
    $row_count=mysqli_num_rows($result); 
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();
    // cart item 

    $select_query_cart="SELECT * FROM `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart); 

    if($row_count>0){
      $_SESSION['username']=$user_username;
      if ($row_data && $user_password == $row_data['user_pd'])
      { 
        // echo "<script>alert('Login successful')</script>";
        if($row_count==1 and $row_count_cart==0){
          $_SESSION['username']=$user_username;
          echo "<script>alert('Login successful')</script>";
          echo "<script>window.open('profile.php', '_self')</script>";
        }
        else{
          $_SESSION['username']=$user_username;
          echo "<script>alert('Login successful')</script>";
          echo "<script>window.open('payment.php', '_self')</script>";
        }
      }
      else{
        echo "<script>alert('Invalid Credentials')</script>";
      }
    }
    else{
        echo "<script>alert('Invalid credentials')</script>";
      }
  }



?>
