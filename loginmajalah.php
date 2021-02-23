<?php 
//memulai session yang disimpan pada browser
session_start();

//cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
if($_SESSION['status']!="sudah_login"){
//melakukan pengalihan
header("location:login.php");
} 
?>
<html>
<head>
<title>Majalah</title>
<style>

</style>
</head>
<body>
<?php

$koneksi = mysqli_connect("localhost","root","","ukk_majalah");

function tambah($koneksi){

    if(isset($_POST['btn_simpan'])){
        $id = time();
        $nama_majalah = $_POST['nama_majalah'];


        if(!empty($nama_majalah)){
            $sql = "INSERT INTO majalah (id, nama_majalah) VALUES ('$id','$nama_majalah')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi']) ){
                if($_GET['aksi'] == 'create'){
                    header('Location: loginmajalah.php');
                }
            }
        }else{
            $pesan = "<p style='color: red'>Tidak dapat menyimpan atau data belum lengkap!</p>";
        }
    }
	
?>

<form action="" method="post" >
<a href="logout.php" >Logout</a>
<center>
<table id="smed" width='90'>
<form>
<td>
	<br></br>
	 <input type="hidden" name="id"><br>
	 
	<b><center>DAFTAR MAJALAH</b>	 
	<br></br>
	<input type="text"  name="nama_majalah"><br>
	 	
	 <br></br>
	  <button type="submit" name="btn_simpan"></i> Simpan</button>
        <button type="reset"></i> Bersihkan</button>
			</form>
</td>
</tr>
</table>
<?php 

}


function tampil_data($koneksi){
    $sql = "SELECT * FROM majalah";
    $query = mysqli_query($koneksi, $sql);

    echo"<legend><h3 style='margin-top:0px;'>Data majalah</h3></legend>";
    echo "<table border='0' cellpadding='5' class='table table-bordered'>";
    echo"<tr>
    <hr></hr>
        <thead class='thead-dark'>
        <th>ID</th>
        <th>Daftar Majalah</th>
        <th><center>Opsi</th></center>
        </tr>";
    $id = 1;
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
		
	</form>
            <td><?php echo $id++; ?></td>
            <td><?php echo $data['nama_majalah']; ?></td>
            <td>
                <a href="loginmajalah.php?aksi=update&id=<?= $data['id']; ?>&nama_majalah=<?= $data['nama_majalah']; ?>" <i class="btn btn-warning"><class="fa fa-edit">Edit</i></a>
                <a href="loginmajalah.php?aksi=delete&id=<?= $data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o">Hapus</i></a>
            </td>
        </tr>
<?php
}
"</table>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id = $_POST['id'];
        $nama_majalah = $_POST['nama_majalah'];


        if(!empty($nama_majalah)){
            $sql_update = "UPDATE majalah SET nama_majalah='$nama_majalah' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: loginmajalah.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id'])){
        ?>

            <div class="container">
            <a href="loginmajalah.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a>
            <a href="loginmajalah.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
            </tr>
                <tr>
                     <td>Daftar Majalah</td>
                     <tr></tr>
					
                     <td><input type="text" class="form-control" name="nama_majalah" value="<?php echo $_GET['nama_majalah'] ?>"/></td>
                </tr>
                <tr></tr>
                <td>
                    <br>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
                <a href="loginmajalah.php?aksi=delete&id=<?php echo $_GET['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>HAPUSS</a>
                </td>
                </tr>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </form>
        <?php
    }
   
}

// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id']) && isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM majalah WHERE id=" . $id;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: loginmajalah.php');
            }
        }
    }
   
}
// --- Tutup Fungsi Hapus
// ===================================================================
// Dari semua elemen
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="loginmajalah.php" class="btn btn-info"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
    tambah($koneksi);
    tampil_data($koneksi);
}
?>
</body>
</html>