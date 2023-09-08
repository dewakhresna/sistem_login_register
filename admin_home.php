<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:admin.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:admin.php');
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  </head>
  <body>

  
    <div class="container">
        <div class="mt-3">
            <h1 class="text-center">Admin Home</h1>    
            <h3 class="text-center">Isi Form</h3>
        </div>
        <div class="card mt-3" style="width: 95rem;">
            <div class="card-header bg-primary text-white">
                <h5>Form Pendaftaran</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NPM</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Lokasi Kampus</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th class="text-center">Email</th>
                        <th>Posisi</th>
                        <th>IPK Terakhir</th>
                        <th colspan="2">Edit</th>
                    </tr>
                    
                    <?php
                    include 'config.php';
                        
                    $no=1;
                    $ambil_data = mysqli_query($conn,"select * from sistem_form");
                    while ($data_tampil = mysqli_fetch_array($ambil_data)){
                        

                        echo "
                        <tr>
                        <td>$no</td>
                        <td>$data_tampil[nama_lengkap]</td>
                        <td>$data_tampil[npm]</td>
                        <td>$data_tampil[kelas]</td>
                        <td>$data_tampil[jurusan]</td>
                        <td>$data_tampil[lokasi_kampus]</td>
                        <td>$data_tampil[tempat_tglahir]</td>
                        <td>$data_tampil[jenis_kelamin]</td>
                        <td>$data_tampil[alamat]</td>
                        <td>$data_tampil[no_hp]</td>
                        <td>$data_tampil[email]</td>
                        <td>$data_tampil[posisi]</td>
                        <td>$data_tampil[ipk]</td>
                        <td><a href='?edit=$data_tampil[nama_lengkap]' class='btn btn-danger'> Hapus </a></td>
                        <td><a href='admin_tambah.php?edit=$data_tampil[nama_lengkap]' class='btn btn-warning'> Ubah </a></td>
                        </tr>";
                                
                            $no++;
                    }
                    ?>
                </table>
            
                <a href="admin_home.php?logout=<?php echo $user_id; ?>" class="btn btn-danger text-center mt-3">Logout</a>
            </div>
        </div>

    </div>
    <?php
    if(isset($_GET['edit'])){
        mysqli_query($conn,"delete from sistem_form where nama_lengkap='$_GET[edit]'");
        
        echo "Data anda telah terhapus";
        echo "<meta http-equiv=refresh content=2;URL='admin_home.php'>";
    }
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>

