<?php  
  include("../includes/connect.php");
  include("../functions/common_function.php");
  // echo "hello ";
  if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];

  }
  $get_ip_address=getIPAddress();
  $total_price=0;
  $cart_query_price = "SELECT * FROM `cart_details` where ip_address='$get_ip_address'";
  $result_cart_price=mysqli_query($con,$cart_query_price); 
  $invoice_number=mt_rand();
  echo "$invoice_number";

  $status='pending';

  $count_products=mysqli_num_rows($result_cart_price); 
  while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['artwork_id'];
    $select_product="SELECT * FROM `artwork` where artwork_id=$product_id";
    $run_price=mysqli_query($con, $select_product);
    while($row_product_price=mysqli_fetch_array($run_price))
    { 
      $product_price=array($row_product_price['artwork_price']);
      $product_values=array_sum($product_price);
      $total_price+=$product_values;
    }
  }

  // getting quantity
  $get_cart="SELECT * FROM `cart_details`";
  $run_cart=mysqli_query($con, $get_cart);
  $get_item_quantity=mysqli_fetch_array($run_cart); 
  $quantity=$get_item_quantity['quantity'];
  if($quantity==0)
  { 
    $quantity=1;
    $subtotal=$total_price;
   
    }else{
      $quantity=$quantity;
      $subtotal=$total_price*$quantity;
  }

  $insert_orders="INSERT INTO  `user_order` (user_id, order_amount, invoice_number, total_products, order_date, order_status) values ($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
  $result_query=mysqli_query($con, $insert_orders);
  if($result_query) 
  {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
  }

//  pending ordrs
  $insert_pending_orders="INSERT INTO `pending_orders` (user_id, invoice_number, artwork_id, quantity, order_status) values ($user_id, $invoice_number, $product_id, $quantity, '$status')";
  $result_pending_orders=mysqli_query($con, $insert_pending_orders);

  // delete items from cartY STEP
  $empty_cart="DELETE FROM  `cart_details` where ip_address='$get_ip_address'";
  $result_delete=mysqli_query($con, $empty_cart);

?>
