<?php

//start session
session_start();

require_once('./php/createDb.php');
require_once('./php/component.php');

//create instance of CreateDb class
$database = new createDb("Productdb", "Producttb");

if(isset($_POST['add'])){
 //print_r($_POST['product_id']);
 if(isset($_SESSION['cart'])){

  $item_array_id = array_column($_SESSION['cart'], "product_id");

   //print_r($item_array_id);

   if(in_array($_POST['product_id'], $item_array_id)){
    echo"<script>alert('Product has already been added to Cart')</script>";
    echo"<script>window.location = 'index.php'</script>";
   } else {
    $count = count($_SESSION['cart']);
     $item_array = array(
   'product_id' => $_POST['product_id']
  );

  $_SESSION['cart'][$count] = $item_array;
 // print_r($_SESSION['cart']);
   }
   
 } else {
  $item_array = array(
   'product_id' => $_POST['product_id']
  );

  //Create new session variable
  $_SESSION['cart'][0] = $item_array;
  //print_r($_SESSION['cart']);
 }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Shopping Cart</title>
 <!-- CSS only -->

<!--Font Awesome  -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet">

 <!-- BootStrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<link href="style.css" rel="stylesheet">
</head>
<body>

<?php require_once("php/header.php") ?>

<div class="container">
 <div class="row text-center py-5">
    <?php
   $result = $database->getData();
  //  while($row = mysqli_fetch_assoc($result)){
  //   component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
  //  }
    ?>
 </div>
</div>
 

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>