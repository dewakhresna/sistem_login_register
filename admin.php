<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass_admin = mysqli_real_escape_string($conn, md5($_POST['password_admin']));

   $select = mysqli_query($conn, "SELECT * FROM `sistem_admin` WHERE username = '$username' AND password_admin = '$pass_admin'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:admin_home.php');
   }else{
      $message_admin[] = 'username atau password salah!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login admin</h3>
      <?php
      if(isset($message_admin)){
         foreach($message_admin as $message_admin){
            echo '<div class="message">'.$message_admin.'</div>';
         }
      }
      ?>
      <input type="text" name="username" placeholder="Masukan Username" class="box" required>
      <input type="password" name="password_admin" placeholder="Masukan Password" class="box" required>
      <input type="submit" name="submit" value="Login Admin" class="btn">
      <p>
        <a href="login.php">login akun</a> atau
        <a href="register.php">buat akun baru</a>
      </p>
   </form>

</div>

</body>
</html>