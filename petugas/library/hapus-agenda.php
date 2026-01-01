<?php
include_once "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM tbl_agenda WHERE id_agenda = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../contents/agenda.php");
}
?>