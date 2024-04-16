<?php
 session_start();
 include_once "config.php"; 
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

 if(!empty($email) && !empty($password)){
   // check if email and password are correct
   $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
   if(mysqli_num_rows($sql) > 0){
     $row = mysqli_fetch_assoc($sql);
     $_SESSION['unique_id'] = $row['unique_id']; //create session using users unique id
     echo "success";
   }else{
    echo "email or password incorrect!";
   }
 } else {
  echo "All input fields are required!";
 }
 ?>