<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_nama_lengkap = mysqli_real_escape_string($conn, $_POST['update_nama_lengkap']);
   $update_npm = mysqli_real_escape_string($conn, $_POST['update_npm']);
   $update_kelas = mysqli_real_escape_string($conn, $_POST['update_kelas']);
   $update_jurusan = mysqli_real_escape_string($conn, $_POST['update_jurusan']);
   $update_lokasi_kampus = mysqli_real_escape_string($conn, $_POST['update_lokasi_kampus']);
   $update_tempat_tglahir = mysqli_real_escape_string($conn, $_POST['update_tempat_tglahir']);
   $update_jenis_kelamin = mysqli_real_escape_string($conn, $_POST['update_jenis_kelamin']);
   $update_alamat = mysqli_real_escape_string($conn, $_POST['update_alamat']);
   $update_no_hp = mysqli_real_escape_string($conn, $_POST['update_no_hp']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_posisi = mysqli_real_escape_string($conn, $_POST['update_posisi']);
   $update_ipk = mysqli_real_escape_string($conn, $_POST['update_ipk']);

   mysqli_query($conn, "UPDATE `sistem_form` SET nama_lengkap = '$update_nama_lengkap', npm = '$update_npm', kelas = '$update_kelas', jurusan = '$update_jurusan', lokasi_kampus = '$update_lokasi_kampus', tempat_tglahir = '$update_tempat_tglahir', jenis_kelamin = '$update_jenis_kelamin', alamat = '$update_alamat', no_hp = '$update_no_hp', email = '$update_email', posisi = '$update_posisi', ipk = '$update_ipk' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'password lama tidak sesuai!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'konfirmasi password tidak sesuai!';
      }else{
         mysqli_query($conn, "UPDATE `sistem_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'berhasil memperbaharui password!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'ukuran gambar terlalu besar';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `sistem_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'gambar berhasil diperbaharui';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `sistem_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Nama Lengkap :</span>
            <input type="text" name="update_nama_lengkap" value="<?php echo $fetch['nama_lengkap']; ?>" class="box">
            <span>Kelas :</span>
            <input type="text" name="update_kelas" value="<?php echo $fetch['kelas']; ?>" class="box">
            <span>Tempat Tanggal Lahir :</span>
            <input type="text" name="update_tempat_tglahir" value="<?php echo $fetch['tempat_tglahir']; ?>" class="box">
            <span>Jenis Kelamin :</span>
            <select name="update_jenis_kelamin" value="<?php echo $fetch['jenis_kelamin']; ?>" class="box">
               <option value="Masukan Jenis Kelamin">Masukan Jenis Kelamin</option>
               <option value="Laki-laki" <?php if("Laki-laki") { echo "selected";} ?>>Laki-laki</option>
               <option value="Perempuan" <?php if("Perempuan") { echo "selected";} ?>>Perempuan</option>
            </select>
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Posisi :</span>
            <select name="update_posisi" value="<?php echo $fetch['posisi']; ?>" class="box">
               <option value="Masukan Posisi">Masukan Posisi</option>
               <option value="Asisten" <?php if("Asisten") { echo "selected";} ?>>Asisten</option>
               <option value="Programmer" <?php if("Programmer") { echo "selected";} ?>>Programmer</option>
            </select>
            <span>IPK Terakhir :</span>
            <input type="text" name="update_ipk" value="<?php echo $fetch['ipk']; ?>" class="box">
            <span>Perbaharui Foto :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <span>NPM :</span>
            <input type="text" name="update_npm" value="<?php echo $fetch['npm']; ?>" class="box">
            <span>Jurusan :</span>
            <input type="text" name="update_jurusan" value="<?php echo $fetch['jurusan']; ?>" class="box">
            <span>Lokasi Kampus :</span>
            <input type="text" name="update_lokasi_kampus" value="<?php echo $fetch['lokasi_kampus']; ?>" class="box">
            <span>Alamat :</span>
            <input type="text" name="update_alamat" value="<?php echo $fetch['alamat']; ?>" class="box">
            <span>No HP :</span>
            <input type="text" name="update_no_hp" value="<?php echo $fetch['no_hp']; ?>" class="box">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="masukan password sebelumnya" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="masukan password baru" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="konfirmasi password baru" class="box">
         </div>
      </div>
      <input type="submit" value="Perbaharui Profil" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">Kembali</a>
   </form>

</div>

</body>
</html>