<?php
 $conn = mysqli_connect('localhost', 'root', '', 'chatapp');
 if(!$conn){
  echo "Error connecting to database" . mysqli_connect_error();
 }
?>