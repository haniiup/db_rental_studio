<?php
include_once "src/koneksi.php";
?>
<div style="margin-bottom: 20px;">
    <h2 style="color: #4a2e6d; margin: 0;"><b>LAPORAN REKAP BULANAN PENDAPATAN</b></h2>
    <p style="color: #666; margin-top: 5px; font-size: 14px;">Menampilkan rangkuman total transaksi sewa studio musik beserta total omzet uang masuk berdasarkan bulan dan tahun.</p>
</div>

<table width="100%">
    <tr>
        <th width="8%" style="text-align: center;"><b>No.</b></th>
        <th width="30%"><b>Bulan Transaksi</b></th>
        <th width="20%" style="text-align: center;"><b>Tahun</b></th>
        <th width="20%" style="text-align: center;"><b>Jumlah Transaksi</b></th>
        <th width="22%"><b>Total Pendapatan (Omzet)</b></th>
    </tr>
<?php
// Query sakti untuk mengelompokkan data berdasarkan Bulan dan Tahun secara otomatis
$query = "SELECT 
            MONTH(booking.tgl_main) AS bulan_angka,
            YEAR(booking.tgl_main) AS tahun,
            COUNT(booking.id_booking) AS total_transaksi,
            SUM(ruangan.harga * booking.durasi_jam) AS total_omzet
          FROM booking
          INNER JOIN ruangan ON booking.id_studio = ruangan.id_studio
          WHERE booking.status_bayar = 'Lunas'
          GROUP BY YEAR(booking.tgl_main), MONTH(booking.tgl_main)
          ORDER BY YEAR(booking.tgl_main) DESC, MONTH(booking.tgl_main) DESC";

$sql = mysqli_query($koneksi, $query);
$nomor = 0;
$grand_total_omzet = 0;

// Array pembantu untuk mengubah angka bulan menjadi teks bahasa Indonesia yang rapi
$nama_bulan = array(
    1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni",
    7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
);

if (mysqli_num_rows($sql) > 0) {
    while ($data = mysqli_fetch_array($sql)) {
        $nomor++;
        $grand_total_omzet += $data['total_omzet'];
?>
    <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><b><?php echo $nama_bulan[$data['bulan_angka']]; ?></b></td>
        <td align="center"><?php echo $data['tahun']; ?></td>
        <td align="center" style="font-weight: bold; color: #5c3c85;"><?php echo $data['total_transaksi']; ?> Kali Sewa</td>
        <td style="font-weight: bold; color: #155724;">Rp <?php echo number_format($data['total_omzet'], 0, ',', '.'); ?></td>
    </tr>
<?php 
    } 
?>
    <!-- Baris Total Paling Bawah Bergaya Premium -->
    <tr style="background-color: #f1ebf7; font-weight: bold;">
        <td colspan="4" align="right" style="color: #4a2e6d; padding: 15px;">GRAND TOTAL PENDAPATAN :</td>
        <td style="color: #4a2e6d; font-size: 16px; padding: 15px;">Rp <?php echo number_format($grand_total_omzet, 0, ',', '.'); ?></td>
    </tr>
<?php
} else {
    echo "<tr><td colspan='5' align='center' style='color: #999; padding: 20px;'>Belum ada transaksi dengan status 'Lunas' bulan ini.</td></tr>";
}
?>
</table>
