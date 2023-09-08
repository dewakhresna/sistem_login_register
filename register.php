<?php

include 'config.php';

if(isset($_POST['submit'])){

   $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
   $npm = mysqli_real_escape_string($conn, $_POST['npm']);
   $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
   $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
   $lokasi_kampus = mysqli_real_escape_string($conn, $_POST['lokasi_kampus']);
   $tempat_tglahir = mysqli_real_escape_string($conn, $_POST['tempat_tglahir']);
   $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
   $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
   $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $posisi = mysqli_real_escape_string($conn, $_POST['posisi']);
   $ipk = mysqli_real_escape_string($conn, $_POST['ipk']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `sistem_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'pengguna sudah ada'; 
   }else{
      if($pass != $cpass){
         $message[] = 'konfirmasi password tidak sesuai!';
      }elseif($image_size > 2000000){
         $message[] = 'ukuran gambar terlalu besar!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `sistem_form`(nama_lengkap, npm, kelas, jurusan, lokasi_kampus, tempat_tglahir, jenis_kelamin, alamat, no_hp, email, posisi, ipk, password, image) VALUES('$nama_lengkap', '$npm', '$kelas', '$jurusan', '$lokasi_kampus', '$tempat_tglahir', '$jenis_kelamin', '$alamat', '$no_hp','$email', '$posisi', '$ipk', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registrasi berhasil!';
            header('location:login.php');
         }else{
            $message[] = 'registrasi gagal!';
         }
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
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>registrasi sekarang</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="nama_lengkap" placeholder="Masukan Nama Lengkap" class="box" required>
      <input type="text" name="npm" placeholder="Masukan NPM" class="box" required>
      <input type="text" name="kelas" placeholder="Masukan Kelas" class="box" required>
      <input type="text" name="jurusan" placeholder="Masukan jurusan" class="box" required>
      <input type="text" name="lokasi_kampus" placeholder="Masukan Lokasi Kampus" class="box" required>
      <input type="text" name="tempat_tglahir" placeholder="Masukan Tempat Tanggal Lahir" class="box" required>
      <select name="jenis_kelamin" class="box">
         <option value="Masukan Jenis Kelamin">Masukan Jenis Kelamin</option>
         <option value="Laki-laki">laki-laki</option>
         <option value="Perempuan">Perempuan</option>
      </select>
      <input type="text" name="alamat" placeholder="Masukan Alamat" class="box" required>
      <input type="text" name="no_hp" placeholder="Masukan No HP" class="box" required>
      <input type="email" name="email" placeholder="Masukan Email" class="box" required>
      <select name="posisi" class="box">
         <option value="Masukan Posisi">Masukan Posisi</option>
         <option value="Asisten">Asisten</option>
         <option value="Programmer">Programmer</option>
      </select>
      <input type="text" name="ipk" placeholder="Masukan IPK" class="box" required>
      <input type="password" name="password" placeholder="Masukan Password" class="box" required>
      <input type="password" name="cpassword" placeholder="Konfirmasi password" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="registrasi" class="btn">
      <p>sudah punya akun? <a href="login.php">login sekarang</a></p>
   </form>

</div>

</body>
</html>