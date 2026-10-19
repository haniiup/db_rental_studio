<?php
include_once "src/koneksi.php";
?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <h2 style="color: #4a2e6d; margin: 0;"><b>DATA PELANGGAN (BAND)</b></h2>
    <!-- Tombol Tambah Data Ungu Kalem -->
    <a href="?open=tambah_pelanggan" style="background-color: #5c3c85; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-weight: bold; font-size: 14px; transition: 0.3s;" onmouseover="this.style.backgroundColor='#4a2e6d'" onmouseout="this.style.backgroundColor='#5c3c85'">+ Tambah Pelanggan</a>
</div>

<table width="100%">
    <tr>
        <th width="5%" style="text-align: center;"><b>No.</b></th>
        <th width="15%"><b>ID Pelanggan</b></th>
        <th width="50%"><b>Nama Grup Band / Penyewa</b></th>
        <th width="15%"><b>No. HP</b></th>
        <th width="15%" style="text-align: center;"><b>Tools</b></th>
    </tr>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
?>
    <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><b>PLG-<?php echo sprintf('%03s', $data['id_petugas'] ?? $data['id_pelanggan']); ?></b></td>
        <td><?php echo $data['nama_grup']; ?></td>
        <td><?php echo $data['no_hp']; ?></td>
        <td align="center">
            <a href="?open=edit_pelanggan&id_pelanggan=<?php echo $data['id_pelanggan']; ?>" style="color: #5c3c85; text-decoration: none; font-weight: bold; margin-right: 10px;">Edit</a> | 
            <a href="?open=hapus_pelanggan&id_pelanggan=<?php echo $data['id_pelanggan']; ?>" style="color: #cc0000; text-decoration: none; font-weight: bold;" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA PELANGGAN INI?')">Delete</a>
        </td>
    </tr>
<?php } ?>
</table>
