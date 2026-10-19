<?php
include_once "src/koneksi.php";

// Membaca variabel id_pelanggan pada URL
if(isset($_GET['id_pelanggan'])){
    $id_pelanggan = $_GET['id_pelanggan'];

    // Hapus data pelanggan sesuai id yang dipilih
    $sql = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    if($sql){
        echo "<center><b><font color='#4a2e6d' size='4'><p>Data Pelanggan Berhasil Dihapus</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_pelanggan'>";
    }
    else {
        echo "<center><b><font color='red' size='4'><p>Data Gagal Dihapus! Eror: ".mysqli_error($koneksi)."</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_pelanggan'>";
    }
}
else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?open=data_pelanggan'>";
}
?>
