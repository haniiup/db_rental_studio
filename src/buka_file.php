<?php
# Kontrol Menu Program Rental Studio Musik
if(isset($_GET['open'])){
    switch($_GET['open']){
        case '' :
            if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
            include "informasi_utama.php"; break;

        // RUTE MENU STUDIO
        case 'data_studio' :
            if(!file_exists ("data_studio.php")) die ("File tidak ada !");
            include "data_studio.php"; break;
        case 'tambah_studio' :
            if(!file_exists ("tambah_studio.php")) die ("File tidak ada !");
            include "tambah_studio.php"; break;
        case 'edit_studio' :
            if(!file_exists ("edit_studio.php")) die ("File tidak ada !");
            include "edit_studio.php"; break;
        case 'hapus_studio' :
            if(!file_exists ("hapus_studio.php")) die ("File tidak ada !");
            include "hapus_studio.php"; break;

        // RUTE MENU PELANGGAN
        case 'data_pelanggan' :
            if(!file_exists ("data_pelanggan.php")) die ("File tidak ada !");
            include "data_pelanggan.php"; break;
        case 'tambah_pelanggan' :
            if(!file_exists ("tambah_pelanggan.php")) die ("File tidak ada !");
            include "tambah_pelanggan.php"; break;
        case 'edit_pelanggan' :
            if(!file_exists ("edit_pelanggan.php")) die ("File tidak ada !");
            include "edit_pelanggan.php"; break;
        case 'hapus_pelanggan' :
            if(!file_exists ("hapus_pelanggan.php")) die ("File tidak ada !");
            include "hapus_pelanggan.php"; break;

        // RUTE MENU BOOKING JADWAL
        case 'data_booking' :
            if(!file_exists ("data_booking.php")) die ("File tidak ada !");
            include "data_booking.php"; break;
        case 'tambah_booking' :
            if(!file_exists ("tambah_booking.php")) die ("File tidak ada !");
            include "tambah_booking.php"; break;
        case 'edit_booking' :
            if(!file_exists ("edit_booking.php")) die ("File tidak ada !");
            include "edit_booking.php"; break;
        case 'hapus_booking' :
            if(!file_exists ("hapus_booking.php")) die ("File tidak ada !");
            include "hapus_booking.php"; break;
        case 'rekap_bulanan' :
            if(!file_exists ("rekap_bulanan.php")) die ("File tidak ada !");
            include "rekap_bulanan.php"; break;

        default:
            if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
            include "informasi_utama.php"; break;
    }
}
else {
    if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
    include "informasi_utama.php";
}
?>
