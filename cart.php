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
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/ all.min.css" integrity="sha512-9usAa1@IRO@HhonpyAIVpjrylPvoDwi PUiKdWk5t3PyolY1c0d4DSE@Ga +ri4AuTroPR5aQvXU9xC6q0PnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <style>
      .card-img-top 
      {
        height: 200px; 
        object-fit: cover;
      }
      .cart_image {
        width: 100px;
        height: 100px;
        object-fit: content;
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
      margin-bottom: 30px;
      }
    </style>
</head>

  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
              <a class="nav-link active nav-heading" aria-current="page" href="index.php">Home</a>
            </li>
           
            <li class="nav-item nav-pad">
              <a class="nav-link nav-heading" href="./user_area/user_registration.php">Register</a>
            </li>

            
          </ul> 
         
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
          <a class='nav-link' href='./user_area/user_login.php'>Login</a>
          </l1>";
        }else{
          echo " <li class='nav-item'>
          <a class='nav-link' href='user_area/logout.php'>Logout</a>
          </li>";
        }
        
        ?>
      </ul>
    </nav>




    <!-- fourth child -->
    <div class="container">
      <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
          
          <tbody>


            <?php
                global $con;
                $get_ip_add = getIPAddress();
                $total_price=0;
                $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                $result=mysqli_query($con,$cart_query);
                $result_count = mysqli_num_rows($result);
                if($result_count>0)
                {
                  echo "<thead>
                          <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th colspan='2'>Operations</th>
                          </tr>
                        </thead> ";

                
                while($row=mysqli_fetch_array($result))
                {
                  $product_id=$row['artwork_id'];
                  $select_products="SELECT * FROM `artwork` where artwork_id='$product_id'";
                  $result_products=mysqli_query($con, $select_products);
                  while($row_product_price =mysqli_fetch_array($result_products)) 
                  {
                    $product_price=array($row_product_price['artwork_price']); 
                    $price_table=$row_product_price['artwork_price'];
                    $product_title= $row_product_price['artwork_title']; 
                    $product_image= $row_product_price['artwork_image'];
                    $product_values=array_sum($product_price); // [500]
                    $total_price+=$product_values; //500
            
              ?>
            <tr>
              <td><?php echo $product_title ?></td>
              <td><img src="./images_products_admin/<?php echo $product_image ?>" alt="" class="cart_image"></td>
              <td><input type="text" name ="qty"></td>
              <?php
               $get_ip_add = getIPAddress();
               if(isset($_POST['update_cart'])){
                $quantity=$_POST['qty'];
                $update_cart ="UPDATE `cart_details` SET quantity=$quantity where  ip_address='$get_ip_add'";
                $result_products_quantity=mysqli_query($con, $update_cart);
                $total_price=$total_price*$quantity;
                }
              ?>

              <td><?php echo $price_table?>/-</td>
              <td><input type="checkbox" name="removeitem[]" value="<?php  echo $product_id?>"></td>
              <td>
                <input type="submit" value="Update Cart" name="update_cart">
      
                <!-- <input type="text" name="quantity" value="<?php echo $quantity ?>"> -->
                <input type="submit" value="Remove Cart" name="remove_cart">
      
              
            </tr>
            <?php
                    }
                  }
                }      
                else{
                  echo " <h2 class='text-center'> cart is empty <h2>";

                }      
              ?>
          </tbody>
        </table>
      
        <!-- subtotal -->
        <div class="d-flex mb-5">
          <?php
            $get_ip_add = getIPAddress();
            $total_price=0;
            $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
            $result=mysqli_query($con,$cart_query);
            $result_count = mysqli_num_rows($result);
            if($result_count>0)
            {
              echo " <h4 class='px-3'>Subtotal:  <strong class='text-info'></ strong></h4>
              <input type='submit' value='Continue shouping ' name ='continue'>
              
                <button class='bg-secondary p-3 py-2 border-0 text-light'><a href='./user_area/checkout.php'>Checkout</a></button>
              ";
            }else{
              echo  "
              <input type='submit' value='Continue shouping ' name ='continue'>
              ";

            }
          if (isset($_POST['continue'])){
            echo "<script>window.open('index.php', '_self')</script>";
          }
          
          ?>
          
        </div>
        </form>
      </div>
    </div> 
    <?php
      function remove_cart_item()
      {
        global $con;
        if(isset($_POST['remove_cart']))
        {
          foreach($_POST['removeitem'] as $remove_id)
          {
            echo $remove_id;
            $delete_query="DELETE FROM  `cart_details` where artwork_id=$remove_id"; 
            $run_delete=mysqli_query($con, $delete_query);
            if($run_delete)
            {
              echo "<script>window.open('cart.php', '_self')</script>";
            }
          }
        }
      }
        echo $remove_item=remove_cart_item();
      
    ?>
  </body>
</html>