<?php
include_once "src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $id_booking   = $_POST['id_booking'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_studio    = $_POST['id_studio'];
    $tgl_main     = $_POST['tgl_main'];
    $jam_mulai    = $_POST['jam_mulai'];
    $durasi_jam   = $_POST['durasi_jam'];
    $status_bayar = $_POST['status_bayar'];

    // Validasi Form Inputs
    $pesanError = array();
    if ($id_pelanggan=="Kosong") { $pesanError[] = "Data <b>Nama Pelanggan</b> belum dipilih !"; }
    if ($id_studio=="Kosong") { $pesanError[] = "Data <b>Ruangan Studio</b> belum dipilih !"; }
    if (trim($tgl_main)=="") { $pesanError[] = "Data <b>Tanggal Main</b> tidak boleh kosong !"; }
    if (trim($jam_mulai)=="") { $pesanError[] = "Data <b>Jam Mulai</b> tidak boleh kosong !"; }
    if (trim($durasi_jam)=="" || $durasi_jam <= 0) { $pesanError[] = "Data <b>Durasi Jam</b> tidak valid !"; }
    if ($status_bayar=="Kosong") { $pesanError[] = "Data <b>Status Bayar</b> belum dipilih !"; }

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
        // Skrip Update data ke Database booking
        $sqlEdit = mysqli_query($koneksi, "UPDATE booking SET id_pelanggan='$id_pelanggan', id_studio='$id_studio', 
                   tgl_main='$tgl_main', jam_mulai='$jam_mulai', durasi_jam='$durasi_jam', status_bayar='$status_bayar' 
                   WHERE id_booking = '$id_booking'");
        if($sqlEdit){
            echo "<center><b><font color='#4a2e6d' size='4'><p>Data Transaksi Berhasil Diubah</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_booking'>";
        }
        else{
            echo "<center><b><font color='red' size='4'><p>Data Gagal Diubah! Eror: ".mysqli_error($koneksi)."</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=index.php?open=data_booking'>";
        }
        exit;
    }
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
if(isset($_GET['id_booking'])){
    $id_booking = $_GET['id_booking'];
    $sql        = mysqli_query($koneksi, "SELECT * FROM booking WHERE id_booking = '$id_booking'");
    $data       = mysqli_fetch_array($sql);
}
?>

<h2 style="color: #4a2e6d; margin-bottom: 20px;"><b>UBAH TRANSAKSI BOOKING JADWAL</b></h2>

<form action="index.php?open=edit_booking&id_booking=<?php echo isset($data['id_booking']) ? $data['id_booking'] : ''; ?>" method="post">
<table width="100%" cellpadding="8" cellspacing="0" style="border: none;">
    <tr>
        <td width="20%"><b>Nota ID</b></td>
        <td width="2%">:</td>
        <td>
            <input name="id_booking" type="hidden" value="<?php echo isset($data['id_booking']) ? $data['id_booking'] : ''; ?>" />
            <input type="text" size="15" value="NOT-<?php echo isset($data['id_booking']) ? sprintf('%04s', $data['id_booking']) : ''; ?>" readonly="true" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; background-color: #f2f2f2; color: #666;" />
        </td>
    </tr>
    <tr>
        <td><b>Nama Grup Band</b></td>
        <td>:</td>
        <td>
            <select name="id_pelanggan" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 40%;">
                <option value="Kosong">--- Pilih Pelanggan ---</option>
                <?php
                $tampil_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_grup ASC");
                while ($rowPlg = mysqli_fetch_array($tampil_pelanggan)){
                    $cek = ($rowPlg['id_pelanggan'] == $data['id_pelanggan']) ? "selected" : "";
                    echo "<option value='".$rowPlg['id_pelanggan']."' $cek>".$rowPlg['nama_grup']."</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><b>Pilih Ruangan Studio</b></td>
        <td>:</td>
        <td>
            <select name="id_studio" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 40%;">
                <option value="Kosong">--- Pilih Studio ---</option>
                <?php
                $tampil_studio = mysqli_query($koneksi, "SELECT * FROM ruangan ORDER BY nama_studio ASC");
                while ($rowStd = mysqli_fetch_array($tampil_studio)){
                    $cek = ($rowStd['id_studio'] == $data['id_studio']) ? "selected" : "";
                    echo "<option value='".$rowStd['id_studio']."' $cek>".$rowStd['nama_studio']." (Rp ".number_format($rowStd['harga'], 0, ',', '.')."/jam)</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><b>Tanggal Latihan</b></td>
        <td>:</td>
        <td><input name="tgl_main" type="date" value="<?php echo isset($data['tgl_main']) ? $data['tgl_main'] : ''; ?>" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 30%;" /></td>
    </tr>
    <tr>
        <td><b>Jam Mulai</b></td>
        <td>:</td>
        <td><input name="jam_mulai" type="time" value="<?php echo isset($data['jam_mulai']) ? $data['jam_mulai'] : ''; ?>" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 30%;" /></td>
    </tr>
    <tr>
        <td><b>Durasi Sewa (Jam)</b></td>
        <td>:</td>
        <td><input name="durasi_jam" type="number" min="1" value="<?php echo isset($data['durasi_jam']) ? $data['durasi_jam'] : ''; ?>" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 20%;" /></td>
    </tr>
    <tr>
        <td><b>Status Pembayaran</b></td>
        <td>:</td>
        <td>
            <select name="status_bayar" style="padding: 6px; border: 1px solid #e1dae8; border-radius: 4px; width: 30%;">
                <option value="Kosong">--- Pilih Status ---</option>
                <option value="DP" <?php echo ($data['status_bayar'] == 'DP') ? 'selected' : ''; ?>>DP (Uang Muka)</option>
                <option value="Lunas" <?php echo ($data['status_bayar'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
            </select>
        </td>
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
