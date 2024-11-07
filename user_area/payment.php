<?php  include("../includes/connect.php");
include("../functions/common_function.php");

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
  <?php
    $ip=getIPAddress();
    $get_user="SELECT * FROM `user_buyer` where user_ip ='$ip'";
    $result=mysqli_query($con , $get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];
  
  ?>
  <div class="container">
    <h2 class="text-center text-info">Payment options</h2>
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-md-6">
        <a href="https://www.paypal.co" target="_blank">
          <img  src="../download.jpeg" alt="img">
        </a>
      </div>
      <div class="col-md-6">
        <a href="order.php?user_id=<?php echo $user_id?>"> 
          <h2>Pay offline</h2>
        </a>
      </div>
    </div>
  </div>
</body>
</html>