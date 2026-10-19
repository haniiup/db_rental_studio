<?php
include_once "src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $nama_grup = $_POST['nama_grup'];
    $no_hp     = $_POST['no_hp'];

    // Validasi Form Inputs
    $pesanError = array();
    if (trim($nama_grup)=="") {
        $pesanError[] = "Data <b>Nama Grup Band</b> tidak boleh kosong !";
    }
    if (trim($no_hp)=="") {
        $pesanError[] = "Data <b>Nomor HP</b> tidak boleh kosong !";
    }

    // Menampilkan Pesan Error dari Form jika ada yang kosong
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
        // Skrip Simpan data ke Database pelanggan
        $sql = mysqli_query($koneksi, "INSERT INTO pelanggan (nama_grup, no_hp) VALUES ('$nama_grup', '$no_hp')");
        if($sql){
            echo "<center><b><font color='#4a2e6d' size='4'><p>Data Pelanggan Berhasil Disimpan</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_pelanggan'>";
        }
        else{
            echo "<center><b><font color='red' size='4'><p>Data Gagal Disimpan! Eror: ".mysqli_error($koneksi)."</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_pelanggan'>";
        }
        exit;
    }
}
?>

<h2 style="color: #4a2e6d; margin-bottom: 20px;"><b>TAMBAH DATA PELANGGAN (BAND)</b></h2>

<form action="index.php?open=tambah_pelanggan" method="post">
<table width="100%" cellpadding="8" cellspacing="0" style="border: none;">
    <tr>
        <td width="20%"><b>Nama Grup Band / Penyewa</b></td>
        <td width="2%">:</td>
        <td><input name="nama_grup" type="text" size="50" maxlength="50" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 60%;" /></td>
    </tr>
    <tr>
        <td><b>Nomor HP</b></td>
        <td>:</td>
        <td><input name="no_hp" type="text" size="20" maxlength="15" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 40%;" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
            <input name="btnSimpan" type="submit" value="Simpan Pelanggan" style="background-color: #5c3c85; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#4a2e6d'" onmouseout="this.style.backgroundColor='#5c3c85'" />
        </td>
    </tr>
</table>
</form>
