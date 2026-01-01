<?php
$koneksi = new mysqli("localhost","root","","db_masjid");
 if(mysqli_connect_errno()){
	trigger_error("Koneksi ke Database gagal!");
 }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM tbl_agenda WHERE id_agenda = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../../petugas/index.php?m=contents&p=agenda");
}
?>