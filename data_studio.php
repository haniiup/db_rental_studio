<?php
include_once "src/koneksi.php";
?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <h2 style="color: #4a2e6d; margin: 0;"><b>DATA RUANGAN STUDIO</b></h2>
    <a href="?open=tambah_studio" style="background-color: #5c3c85; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-weight: bold; font-size: 14px; transition: 0.3s;" onmouseover="this.style.backgroundColor='#4a2e6d'" onmouseout="this.style.backgroundColor='#5c3c85'">+ Tambah Ruangan</a>
</div>

<table width="100%">
    <tr>
        <th width="5%" style="text-align: center;"><b>No.</b></th>
        <th width="15%"><b>ID Studio</b></th>
        <th width="45%"><b>Nama Ruangan Studio</b></th>
        <th width="20%"><b>Harga / Jam</b></th>
        <th width="15%" style="text-align: center;"><b>Tools</b></th>
    </tr>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM ruangan ORDER BY id_studio ASC");
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
?>
    <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><b><?php echo $data['id_studio']; ?></b></td>
        <td><?php echo $data['nama_studio']; ?></td>
        <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
        <td align="center">
            <!-- Link Aksi Edit dan Delete Bergaya Rapi -->
            <a href="?open=edit_studio&id_studio=<?php echo $data['id_studio']; ?>" style="color: #5c3c85; text-decoration: none; font-weight: bold; margin-right: 10px;">Edit</a> | 
            <a href="?open=hapus_studio&id_studio=<?php echo $data['id_studio']; ?>" style="color: #cc0000; text-decoration: none; font-weight: bold;" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA STUDIO INI?')">Delete</a>
        </td>
    </tr>
<?php } ?>
</table>
