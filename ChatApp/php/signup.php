<?php
 session_start();
 include_once "config.php";
 $fname = mysqli_real_escape_string($conn, $_POST['fname']);
 $lname = mysqli_real_escape_string($conn, $_POST['lname']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

 if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
   // check validity of the user email
   if(filter_var($email, FILTER_VALIDATE_EMAIL)){
     // check if email already exists
     $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}");
     if(mysqli_num_rows($sql) > 0){
      echo "$email - This email already exist!!";
     }else{
      // check if user uploaded an image
      if(isset($_FILES['image'])){
        $img_name = $_FILES['image']['name']; //uploaded image name
        $img_type = $_FILES['image']['type']; // uploaded image type
        $tmp_name = $_FILES['image']['tmp_name']; // tmp name used to save or move file

        // explode image and  get the name extension
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ['png', 'jpeg', 'jpg']; //valid image extensions
        if(in_array($img_ext, $extensions) ===  true){//check if the email extension is valid
          $time = time();

          // move the user image to folder for storage
          $new_img_name = $time.$img_name;
          if(move_uploaded_file($tmp_name,"images/".$new_img_name )){
           $status = "Active now"; //once signed up user status becomes active
           $random_id = rand(time(), 10000000); //generate random/unique id for the user

           //insert all user data inside the table
           $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}',");
      
            if($sql2){ // if insertion is successful
              $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
              if(mysqli_num_rows($sql3) > 0){
               $row = mysqli_fetch_assoc($sql3);
               $_SESSION['unique_id'] = $row['unique_id']; //create session using users unique id
               echo "success";
              }
            }else{
              echo "Something went wrong!!!"; 
            }
          };
        }else{
         echo "Please select the Image file type!";
        }
      } else {
       echo "Please select Image file!";
      }
     }
   } else {
    echo "$email - This is not a valid email!";
   }
 } else {
  echo "All input fields are required";
 }
?>