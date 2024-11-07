<?php
  // include('.\includes\connect.php');

  function getProducts() {
    global $con ;

    //  condition to check isset 
    if(!isset($_GET['category']))
    {
      $select_query="SELECT * FROM `artwork` ORDER BY rand() LIMIT 0,10";
      $result_query=mysqli_query($con, $select_query); 

      while($row=mysqli_fetch_assoc($result_query))
      {
        $product_id=$row['artwork_id']; 
        $product_title=$row['artwork_title'];
        $product_description=$row['artwork_desc']; 
        $product_image=$row['artwork_image'];
        $product_price=$row['artwork_price'];
        $category_id=$row['category_id']; 

        echo "
        <div class='col-md-4 my-3'>
          <div class='card'>
            <img src='./images_products_admin/$product_image' 
            class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>Price: $product_price</p>
              <a href='index.php?add_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>view</a>
            </div>
          </div>
        </div>";
      }
    }
  }

  // categories showing in home page 

  function Showcategoreis() {
    global $con;
    $select_categories="SELECT * FROM `category`";
            $result_categories=mysqli_query($con, $select_categories);
            while($row_data=mysqli_fetch_assoc($result_categories))
             {
                $category_title=$row_data['category_title']; 
                $category_id=$row_data['category_id'];
                echo "<li class='nav-item'>
                <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a></li>";
              }      
  }

  // catergories 
  function GetCategory(){
    global $con ;

    //  condition to check isset 
    if(isset($_GET['category']))
    {
      $category_id =$_GET['category'];
      $select_query="SELECT * FROM `artwork` where category_id=$category_id";
      $result_query=mysqli_query($con, $select_query); 

      $num_of_rows=mysqli_num_rows($result_query);
      if($num_of_rows==0){
        echo "<h2> no stock available </h2>";
      }

      while($row=mysqli_fetch_assoc($result_query))
      {
        $product_id=$row['artwork_id']; 
        $product_title=$row['artwork_title'];
        $product_description=$row['artwork_desc']; 
        $product_image=$row['artwork_image'];
        $product_price=$row['artwork_price'];
        $category_id=$row['category_id']; 

        echo "
        <div class='col-md-4'>
          <div class='card'>
            <img src='./images_products_admin/$product_image' 
            class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>Price: $product_price</p>
              <a href='index.php?add_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>view</a>
            
            </div>
          </div>
        </div>";
      }
    }

  }
  // searching products 
  function SearchFunction(){
    global $con;
    if (isset($_GET['search_data_products'])) {
      $user_search = $_GET['search_data'];
      $search_query = "SELECT * FROM `artwork` WHERE artwork_keyword LIKE '%" . $user_search . "%'";
      $result_query = mysqli_query($con, $search_query);
      
      $num_of_rows=mysqli_num_rows($result_query);
      if($num_of_rows==0){
        echo "<h2> no search found  </h2>";
      }
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['artwork_id'];
        $product_title = $row['artwork_title'];
        $product_description = $row['artwork_desc'];
        $product_image = $row['artwork_image'];
        $product_price = $row['artwork_price'];
        $category_id = $row['category_id'];

        echo "
        <div class='col-md-4'>
          <div class='card'>
            <img src='./images_products_admin/$product_image' 
            class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>Price: $product_price</p>
              <a href='index.php?add_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>view</a>
              
            </div>
          </div>
        </div>";
      }
    }
  }

// view more function 

  function viewMore(){
    global $con ;

    //  condition to check isset 
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category']))
    {
      $product_id = $_GET['product_id'];

      $select_query="SELECT * FROM `artwork` where artwork_id =$product_id";
      $result_query=mysqli_query($con, $select_query); 

      while($row=mysqli_fetch_assoc($result_query))
      {
        $product_id=$row['artwork_id']; 
        $product_title=$row['artwork_title'];
        $product_description=$row['artwork_desc']; 
        $product_image=$row['artwork_image'];
        $product_price=$row['artwork_price'];
        $category_id=$row['category_id']; 

        echo "
        <div class='col-md-4'>
          <div class='card'>
            <img src='./images_products_admin/$product_image' 
            class='card-img-top' alt='$product_title'>
           
          </div>
        </div>
    
        <div class='col-md-8'>
          <div class='row'>
            <div class='col-md-12'>
              <h4 class='text-center text-info mb-5'>Related products</h4>
            </div>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Price: $product_price</p>
            <a href='index.php?add_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
            <a href='index.php' class='btn btn-primary'>Go home </a>
          </div>
          </div>
        </div>";
        }
      }
    }
  }
   

  // cart function 

  function cartAdd(){
    if(isset($_GET['add_cart']))
    {
      global $con;
      $ip =getIPAddress() ;

      $get_product_id=$_GET['add_cart'];
      $select_query=" SELECT * FROM `cart_details` where ip_address ='$ip' and artwork_id=$get_product_id";
      $result_query=mysqli_query($con, $select_query);
      $num_of_rows=mysqli_num_rows($result_query);
      if($num_of_rows>0){
        echo "<script>alert('This item is already present inside cart') </script>";
        echo "<script>window.open('index.php', '_self')</script>"; 
      }
      else
      {
        $insert_query="INSERT INTO `cart_details` (artwork_id, quantity, ip_address) values ($get_product_id, 0 , '$ip')";
        $result_query=mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart') </script>";
        echo "<script>window.open('index.php', '_self')</script>";
      }
    } 
  }

  // cart item number function
  
  function cartItem(){
    if(isset($_GET['add_cart']))
    {
      global $con;
      $get_product_id=$_GET['add_cart'];
      $select_query=" SELECT * FROM `cart_details` where artwork_id=$get_product_id";
      $result_query=mysqli_query($con, $select_query);
      $num_of_rows=mysqli_num_rows($result_query);
      if($num_of_rows>0){
        echo "<script>alert('This item is already present inside cart') </script>";
        echo "<script>window.open('index.php', '_self')</script>"; 
      }
      else
      {
        $insert_query="INSERT INTO `cart_details` (artwork_id, quantity) values ($get_product_id, 0)";
        $result_query=mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart') </script>";
        echo "<script>window.open('index.php', '_self')</script>";
      }
    } 
  }

  // total price function 
  // function totalPriceCart(){
  //   global $con;
  //   $get_product_id=$_GET['add_cart'];
  //   $cart_query="SELECT * FROM `cart_details` where artwork_id='$get_ip_add'"; 
  //   $result=mysqli_query($con,$cart_query);
  //   $total_price=0;
  //   while($row=mysqli_fetch_array($result))
  //   {
  //     $product_id=$row['artwork_id'];
  //     $select_products="SELECT * FROM  `artwork` where artwork_id='$product_id"; 
  //     $result_products=mysqli_query($con, $select_products);
  //     while($row_product_price=mysqli_fetch_array($result_products))
  //     {
  //       $product_price=array($row_product_price['artwork_price']); 
  //       $product_values=array_sum($product_price); 
  //       $total_price+=$product_values; 
  //     }
  //     echo $total_price;

  //   }
  // }

  // total price function
  function totalPriceCart() {
    global $con;

    // Calculate the total price by joining cart_details and artwork tables
    $query = "SELECT SUM(artwork.artwork_price) AS total_price
              FROM cart_details
              INNER JOIN artwork ON cart_details.artwork_id = artwork.artwork_id";
    
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_price = $row['total_price'];
        echo $total_price;
    } else {
        echo "Error fetching total price.";
    }
  }

  // get ip adddress

  function getIPAddress() {  
    //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {  
      $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {  
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    //whether ip is from the remote address  
    else{  
      $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
    }  

    // get user order details
    // function order_details_get()
    // {
    //   global $con;
    //   $username = $_SESSION['username'];
    //   $get_details = "SELECT * FROM `user_buyer` WHERE user_name = '$username'";
    //   $result_query = mysqli_query($con, $get_details);
    
    //   while ($row_query = mysqli_fetch_array($result_query)) {
    //     $user_id = $row_query['user_id'];
    
    //     if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
    //       $get_orders = "SELECT * FROM `user_order` WHERE user_id = $user_id AND order_status = 'pending'";
    //       $result_query_order = mysqli_query($con, $get_orders);
    //       $row_count = mysqli_num_rows($result_query_order);
    
    //       if ($row_count > 0) {
    //         echo "<h3 class='text-center'>You have $row_count pending orders</h3>";
    //         echo"hi indeide func ";
    //       }
    //     }
    //   }
    // }

    

  // get user order details 
  function get_user_order_details()
  {
    global $con;
    $username=$_SESSION['username'];
    
    $get_details="SELECT * FROM `user_buyer` where user_name='$username'" ;
    $result_query=mysqli_query($con, $get_details);
    while($row_query=mysqli_fetch_array($result_query)){
      $user_id=$row_query['user_id'];
      if(!isset($_GET['edit_account'])){
        if(!isset($_GET['my_orders'])){
          if(!isset($_GET['delete_account'])){
            $get_orders="SELECT * FROM  `user_order` where user_id=$user_id and order_status='pending'";
            $result_order_query=mysqli_query($con, $get_orders);
            $row_count=mysqli_num_rows($result_order_query);
            if($row_count>0)
            {
             
              echo "<h3 class='text-center'>You have <span class='text-danger'>$row_count </ span>pending orders</h3>
              <a href='profile.php?my_orders'>Order details</a>";
            } 
            else{
              echo "<h3 class='text-center'>You have 0 pending orders</h3>
              <a href='../index.php'>Explore products </a>";
           

            }
          }
        }
      }
    }
  }


?>