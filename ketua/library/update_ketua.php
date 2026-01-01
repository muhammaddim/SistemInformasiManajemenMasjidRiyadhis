<?php
include_once "database.php";  // Pastikan untuk memasukkan koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_ketua = $_POST['id_ketua'];
    $username = $koneksi->escape_string($_POST['username']);
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Encrypt password
    $nama_lengkap = $koneksi->escape_string($_POST['nama_lengkap']);
    $alamat = $koneksi->escape_string($_POST['alamat']);
    $no_hp = $koneksi->escape_string($_POST['no_hp']);
    $jabatan = $koneksi->escape_string($_POST['jabatan']);

    // Query untuk update data ketua
    if ($password) {
        // Jika password diisi, update password
        $sql = "UPDATE tbl_ketua SET username='$username', password='$password', nama_lengkap='$nama_lengkap', alamat='$alamat', no_hp='$no_hp', jabatan='$jabatan' WHERE id_ketua='$id_ketua'";
    } else {
        // Jika password tidak diubah, update hanya data lainnya
        $sql = "UPDATE tbl_ketua SET username='$username', nama_lengkap='$nama_lengkap', alamat='$alamat', no_hp='$no_hp', jabatan='$jabatan' WHERE id_ketua='$id_ketua'";
    }

    // Jalankan query
    if ($koneksi->query($sql)) {
        echo "<script>alert('Data Ketua berhasil diupdate!'); window.location.href='../daftar_ketua.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>
