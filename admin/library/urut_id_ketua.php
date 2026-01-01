<?php
include_once "database.php";

// Ambil ID terbesar di tabel ketua
$query = $koneksi->query("SELECT max(id_ketua) as maxID FROM tbl_ketua");
$data = $query->fetch_assoc();
$kodeTerbesar = $data['maxID'];

// Ambil angka dari kode (misal K003 ➔ ambil 003)
$urutan = (int) substr($kodeTerbesar, 1, 3);

// Tambah 1
$urutan++;

// Format dengan leading zero (001, 002, dst)
$id_ketua = "K" . sprintf("%03s", $urutan);
?>
