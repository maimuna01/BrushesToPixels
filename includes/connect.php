<?php
$con=mysqli_connect('localhost', 'root','' ,'ecomweb');
if(!$con){
  die(mysqli_error($con));
  echo "error ";
}


?>