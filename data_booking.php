<?php
include_once "src/koneksi.php";
?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <h2 style="color: #4a2e6d; margin: 0;"><b>DATA BOOKING JADWAL STUDIO</b></h2>
    <!-- Tombol Tambah Transaksi Ungu Elegan -->
    <a href="?open=tambah_booking" style="background-color: #5c3c85; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-weight: bold; font-size: 14px; transition: 0.3s;" onmouseover="this.style.backgroundColor='#4a2e6d'" onmouseout="this.style.backgroundColor='#5c3c85'">+ Tambah Booking</a>
</div>

<table width="100%">
    <tr>
        <th width="4%" style="text-align: center;"><b>No.</b></th>
        <th width="10%"><b>Nota ID</b></th>
        <th width="23%"><b>Nama Grup Band</b></th>
        <th width="20%"><b>Ruangan Studio</b></th>
        <th width="15%"><b>Jadwal Main</b></th>
        <th width="13%"><b>Total Biaya</b></th>
        <th width="8%" style="text-align: center;"><b>Status</b></th>
        <th width="7%" style="text-align: center;"><b>Tools</b></th>
    </tr>
<?php
// Menggunakan teknik INNER JOIN untuk menyatukan 3 tabel database sekaligus
$query = "SELECT booking.*, pelanggan.nama_grup, ruangan.nama_studio, ruangan.harga 
          FROM booking 
          INNER JOIN pelanggan ON booking.id_pelanggan = pelanggan.id_pelanggan 
          INNER JOIN ruangan ON booking.id_studio = ruangan.id_studio 
          ORDER BY booking.id_booking DESC";

$sql = mysqli_query($koneksi, $query);
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
    
    // Logika menghitung otomatis total biaya sewa (Harga per jam dikali durasi jam main)
    $total_biaya = $data['harga'] * $data['durasi_jam'];
?>
    <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><b>NOT-<?php echo sprintf('%04s', $data['id_booking']); ?></b></td>
        <td><?php echo $data['nama_grup']; ?></td>
        <td><?php echo $data['nama_studio']; ?></td>
        <td>
            <?php 
                // Mengubah format tampilan tanggal agar lebih rapi dibaca
                echo date('d-m-Y', strtotime($data['tgl_main'])); 
            ?>
            <br>
            <span style="font-size: 12px; color: #666;">Jam: <?php echo substr($data['jam_mulai'], 0, 5); ?> (<?php echo $data['durasi_jam']; ?> Jam)</span>
        </td>
        <td>Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></td>
        <td align="center">
            <?php if($data['status_bayar'] == 'Lunas') { ?>
                <span style="background-color: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">Lunas</span>
            <?php } else { ?>
                <span style="background-color: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">DP</span>
            <?php } ?>
        </td>
        <td align="center">
            <a href="?open=edit_booking&id_booking=<?php echo $data['id_booking']; ?>" style="color: #5c3c85; text-decoration: none; font-weight: bold;">Ubah</a>
        </td>
    </tr>
<?php } ?>
</table>
