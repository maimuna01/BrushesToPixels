<?php  
include("../includes/connect.php");
include("../functions/common_function.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

   <!-- bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 

</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2> 
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post" enctype="multipart/form-data">
          
          <!-- Username  -->
          <div class="form-outline mb-4">
            <label for="user_username" class="form-label">Username</label> 
            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" 
            autocomplete="off" required="required" name="user_username"/>
          </div>
          <!-- email field  -->
          <div class="form-outline mb-4">
            <label for="user_email" class="form-label">Email</label> 
            <input type="email" id="user_email" class="form-control" placeholder="Enter your email" 
                  autocomplete="off" required="required" name="user_email"/>
          </div>
          <!-- image fiel   -->
          <div class="form-outline mb-4">
            <label for="user_image" class="form-label">User  Image </label> 
            <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
          </div>
          <!-- password field  -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label> 
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password " 
                  autocomplete="off" required="required" name="user_password"/>
          </div>
          <!-- password field confirm  -->
          <div class="form-outline mb-4">
            <label for="user_password_conf" class="form-label"> Conform Password</label> 
            <input type="password" id="user_password_conf" class="form-control" placeholder="Confirm your password " 
                  autocomplete="off" required="required" name="user_password_conf"/>
          </div>
           <!-- Address field   -->
           <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label> 
            <input type="text" id="user_address" class="form-control" placeholder="Enter your Address" 
            autocomplete="off" required="required" name="user_address"/> 
          </div>
          <!-- contact field   -->
          <div class="form-outline mb-4">
            <label for="user_contact" class="form-label">Contact</label> 
            <input type="text" id="user_contact" class="form-control" placeholder="Enter your Contact" 
            autocomplete="off" required="required" name="user_contact"/> 
          </div>
          <div class="text-center">
            <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name ="user_reg">
            <p>Already ahev and account ? <a href="user_login.php">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  if(isset($_POST['user_reg']))
  {
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $conf_user_password=$_POST['user_password_conf'];
    $user_address=$_POST['user_address']; 
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();
    
    // select query 
    $select_query="SELECT * FROM `user_buyer` where user_name='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con, $select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
      echo "<script>alert('Username and email already exists')</script>";
    }
    else if($user_password!=$conf_user_password){
      echo "<script>alert('Password doesnt match')</script>";
   
    }
    else{
      // insert_query
      move_uploaded_file($user_image_tmp , "./user_images/$user_image");
      $insert_query="INSERT INTO `user_buyer` (user_name, user_email, user_pd, user_image,user_ip, user_address, user_mobile) 
      values ('$user_username', '$user_email', '$user_password',
      '$user_image', '$user_ip', '$user_address', '$user_contact')";
      
      $sql_execute=mysqli_query($con, $insert_query);
      if ($sql_execute){
        echo "<script>alert('Data inserted successfully')</script>";
      }else{
        die(mysqli_error($con));
      }

    }
    // selecting cart items 
   
    $select_cart_items="SELECT * FROM  `cart_details` where ip_address='$user_ip'";
    $result_cart=mysqli_query($con, $select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if ($rows_count>0){
      $_SESSION['username']=$user_username;
      echo "<script>alert('You have items in your cart')</script>"; 
      echo "<script>window.open('checkout.php', '_self')</script>"; 
    }
    else{
      echo "window.open('../index.php', '_self'>";
    }
    
  }


?>

