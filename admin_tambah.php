<?php
include "config.php";
$sql=mysqli_query($conn,"select * from sistem_form where nama_lengkap='$_GET[edit]'");
$isi_data=mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="update-profile">
   <form action="" method="post" >
      <?php
         if($isi_data['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$isi_data['image'].'">';
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Nama Lengkap :</span>
            <input type="text" name="nama_lengkap" value="<?php echo $isi_data['nama_lengkap']; ?>" class="box">
            <span>Kelas :</span>
            <input type="text" name="kelas" value="<?php echo $isi_data['kelas']; ?>" class="box">
            <span>Tempat Tanggal Lahir :</span>
            <input type="text" name="tempat_tglahir" value="<?php echo $isi_data['tempat_tglahir']; ?>" class="box">
            <span>Jenis Kelamin :</span>
            <select name="jenis_kelamin" value="<?php echo $isi_data['jenis_kelamin']; ?>" class="box">
               <option value="Masukan Jenis Kelamin">Masukan Jenis Kelamin</option>
               <option value="Laki-laki" <?php if("Laki-laki") { echo "selected";} ?>>Laki-laki</option>
               <option value="Perempuan" <?php if("Perempuan") { echo "selected";} ?>>Perempuan</option>
            </select>
            <span>Email :</span>
            <input type="email" name="email" value="<?php echo $isi_data['email']; ?>" class="box">
            <span>Posisi :</span>
            <select name="posisi" value="<?php echo $isi_data['posisi']; ?>" class="box">
               <option value="Masukan Posisi">Masukan Posisi</option>
               <option value="Asisten" <?php if("Asisten") { echo "selected";} ?>>Asisten</option>
               <option value="Programmer" <?php if("Programmer") { echo "selected";} ?>>Programmer</option>
            </select>
         </div>
         <div class="inputBox">
            <span>NPM :</span>
            <input type="text" name="npm" value="<?php echo $isi_data['npm']; ?>" class="box">
            <span>Jurusan :</span>
            <input type="text" name="jurusan" value="<?php echo $isi_data['jurusan']; ?>" class="box">
            <span>Lokasi Kampus :</span>
            <input type="text" name="lokasi_kampus" value="<?php echo $isi_data['lokasi_kampus']; ?>" class="box">
            <span>Alamat :</span>
            <input type="text" name="alamat" value="<?php echo $isi_data['alamat']; ?>" class="box">
            <span>No HP :</span>
            <input type="text" name="no_hp" value="<?php echo $isi_data['no_hp']; ?>" class="box">
            <span>IPK Terakhir :</span>
            <input type="text" name="ipk" value="<?php echo $isi_data['ipk']; ?>" class="box">
         </div>
      </div>
      <input type="submit" value="Perbaharui Profil" name="proses" class="btn">
      <a href="admin_home.php" class="delete-btn">Kembali</a>
   </form>
</div>

<?php
include "config.php";

if(isset($_POST['proses'])){
    mysqli_query($conn,"update sistem_form set  
    npm = '$_POST[npm]',
    kelas = '$_POST[kelas]',
    jurusan = '$_POST[jurusan]',
    lokasi_kampus = '$_POST[lokasi_kampus]',
    tempat_tglahir = '$_POST[tempat_tglahir]',
    jenis_kelamin = '$_POST[jenis_kelamin]',
    alamat = '$_POST[alamat]',
    no_hp = '$_POST[no_hp]',
    email = '$_POST[email]',
    posisi = '$_POST[posisi]',
    ipk = '$_POST[ipk]'
    where nama_lengkap = '$_GET[edit]'");

    header('location:admin_home.php');
}
?>
   
</body>
</html>
