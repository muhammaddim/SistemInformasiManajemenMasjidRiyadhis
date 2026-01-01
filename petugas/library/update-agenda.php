<?php
include_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $jamawal = $_POST['jamawal'];
    $jamakhir = $_POST['jamakhir'];
    $tglawal = $_POST['tglawal'];
    $tglakhir = $_POST['tglakhir'];
    $keterangan = $_POST['keterangan'];

    $stmt = $koneksi->prepare("UPDATE tbl_agenda SET judul=?, jam_awal=?, jam_akhir=?, tgl_awal=?, tgl_akhir=?, keterangan=? WHERE id_agenda=?");
    $stmt->bind_param("ssssssi", $judul, $jamawal, $jamakhir, $tglawal, $tglakhir, $keterangan, $id);
    $stmt->execute();

    header("Location: ../agenda.php");
}
?>