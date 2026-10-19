<?php
include_once "src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $id_studio   = $_POST['id_studio'];
    $nama_studio = $_POST['nama_studio'];
    $harga       = $_POST['harga']; // Mengambil nilai kolom harga yang baru

    // Validasi Form Inputs
    $pesanError = array();
    if (trim($id_studio)=="") {
        $pesanError[] = "Data <b>ID Studio</b> tidak boleh kosong !";
    }
    if (trim($nama_studio)=="") {
        $pesanError[] = "Data <b>Nama Studio</b> tidak boleh kosong !";
    }
    if (trim($harga)=="") {
        $pesanError[] = "Data <b>Harga per Jam</b> tidak boleh kosong !";
    }

    if (count($pesanError)>=1 ){
        $noPesan=0;
        echo "<div style='color: #cc0000; margin-bottom: 15px; font-weight: bold;'>";
        foreach ($pesanError as $indeks=>$pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "</div>";
    }
    else {
        // PERBAIKAN DI SINI: Query update diarahkan ke kolom 'harga'
        $sqlEdit = mysqli_query($koneksi, "UPDATE ruangan SET nama_studio='$nama_studio', harga='$harga' 
                   WHERE id_studio = '$id_studio'");
        if($sqlEdit){
            echo "<center><b><font color='#4a2e6d' size='4'><p>Data Ruangan Berhasil Diubah</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_studio'>";
        }
        else{
            echo "<center><b><font color='red' size='4'><p>Data Gagal Diubah! Eror: ".mysqli_error($koneksi)."</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_studio'>";
        }
        exit;
    }
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
if(isset($_GET['id_studio'])){
    $id_studio = $_GET['id_studio'];
    $sql       = mysqli_query($koneksi, "SELECT * FROM ruangan WHERE id_studio = '$id_studio'");
    $data      = mysqli_fetch_array($sql);
}
?>

<h2 style="color: #4a2e6d; margin-bottom: 20px;"><b>UBAH DATA RUANGAN STUDIO</b></h2>

<form action="index.php?open=edit_studio&id_studio=<?php echo isset($data['id_studio']) ? $data['id_studio'] : ''; ?>" method="post">
<table width="100%" cellpadding="8" cellspacing="0" style="border: none;">
    <tr>
        <td width="20%"><b>ID Studio</b></td>
        <td width="2%">:</td>
        <td><input name="id_studio" type="text" size="10" value="<?php echo isset($data['id_studio']) ? $data['id_studio'] : ''; ?>" readonly="true" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; background-color: #f2f2f2; color: #666;" /></td>
    </tr>
    <tr>
        <td><b>Nama Ruangan Studio</b></td>
        <td>:</td>
        <td><input name="nama_studio" type="text" size="50" maxlength="50" value="<?php echo isset($data['nama_studio']) ? $data['nama_studio'] : ''; ?>" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 60%;" /></td>
    </tr>
    <tr>
        <td><b>Harga / Jam (Rp)</b></td>
        <td>:</td>
        <td><input name="harga" type="number" min="0" value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 40%;" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
            <input name="btnSimpan" type="submit" value="Simpan Perubahan" style="background-color: #5c3c85; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#4a2e6d'" onmouseout="this.style.backgroundColor='#5c3c85'" />
        </td>
    </tr>
</table>
</form>
