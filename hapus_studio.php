<?php
include_once "src/koneksi.php";

// Membaca variabel id_studio pada URL alamat browser
if(isset($_GET['id_studio'])){
    $id_studio = $_GET['id_studio'];

    // Hapus data sesuai id yang terbaca
    $sql = mysqli_query($koneksi, "DELETE FROM ruangan WHERE id_studio='$id_studio'");
    if($sql){
        echo "<center><b><font color='#4a2e6d' size='4'><p>Data Ruangan Berhasil Dihapus</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_studio'>";
    }
    else {
        echo "<center><b><font color='red' size='4'><p>Data Gagal Dihapus! Eror: ".mysqli_error($koneksi)."</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_studio'>";
    }
}
else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?open=data_studio'>";
}
?>
