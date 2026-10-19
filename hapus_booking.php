<?php
include_once "src/koneksi.php";

if(isset($_GET['id_booking'])){
    $id_booking = $_GET['id_booking'];
    $sql = mysqli_query($koneksi, "DELETE FROM booking WHERE id_booking='$id_booking'");
    echo "<meta http-equiv='refresh' content='0; url=index.php?open=data_booking'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?open=data_booking'>";
}
?>
