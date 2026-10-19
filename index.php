<?php
include_once "src/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>RENTAL STUDIO MUSIK PREMIUM</title>
    <style>
        /* Desain Background & Tulisan Umum */
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0;
            padding: 40px 20px;
            background-color: #f3eff7; 
            color: #333;
        }

        /* Pembungkus Utama Agar Konten di Tengah dan Rapi */
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        h1 {
            color: #4a2e6d; 
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 28px;
        }

        /* Menu Navigasi Atas Premium */
        .menu { 
            background-color: #5c3c85; 
            padding: 5px 10px; 
            border-radius: 8px; 
            margin-bottom: 25px; 
            box-shadow: 0 4px 6px rgba(92, 60, 133, 0.15);
        }
        .menu a { 
            color: #ffffff; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: inline-block; 
            font-weight: bold; 
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        /* Efek saat menu disentuh mouse */
        .menu a:hover { 
            background-color: #4a2e6d; 
            border-radius: 6px; 
        }

        /* Kotak Tempat Isi Konten Putih Mewah */
        .konten { 
            background-color: #ffffff; 
            padding: 40px; 
            border-radius: 12px; 
            border: 1px solid #e1dae8; 
            min-height: 350px; 
            box-shadow: 0 8px 24px rgba(92, 60, 133, 0.08);
        }

        /* Desain Tabel Data Biar Serasi */
        table { 
            border-collapse: collapse; 
            width: 100%;
            margin-top: 20px; 
            background: white; 
            border-radius: 6px;
            overflow: hidden;
        }
        th, td { 
            border: 1px solid #e1dae8; 
            padding: 12px 15px; 
            text-align: left; 
        }
        th { 
            background-color: #f1ebf7; 
            color: #4a2e6d;
            font-weight: bold;
        }
        tr:hover {
            background-color: #fcfaff; 
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Administrasi Rental Studio Musik</h1>
        
        <!-- Menu Navigasi Atas (Kembali Dimunculkan) -->
            <!-- Menu Navigasi Atas Premium -->
    <div class="menu">
        <a href="?open=">HOME</a>
        <a href="?open=data_studio">DATA STUDIO</a>
        <a href="?open=data_pelanggan">DATA PELANGGAN</a>
        <a href="?open=data_booking">BOOKING JADWAL</a>
        <a href="?open=rekap_bulanan">REKAP BULANAN</a>
    </div>


        <!-- Kotak Putih Wadah Konten & Gambar (Kembali Membungkus Rapi) -->
        <div class="konten">
            <?php include "src/buka_file.php"; ?>
        </div>
    </div>

</body>
</html>
