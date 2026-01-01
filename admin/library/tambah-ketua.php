<?php
include_once 'koneksidb.php';
session_start();

$id_admin  = $_SESSION['id_admin'];
$id_ketua  = $_POST['id_ketua'];  // Menggunakan id_ketua
$no_ktp    = $_POST['no_ktp'];
$nama      = $_POST['nama_ketua'];  // Menggunakan nama_ketua
$alamat    = $_POST['alamat'];
$no_hp     = str_replace(" ", "", $_POST['no_hp']);
$username  = $_POST['username'];
$password  = $_POST['password'];
$password2 = $_POST['password2'];

// Validasi konfirmasi password
if ($password !== $password2) {
    echo "<script> 
        alert('Konfirmasi password tidak sesuai');
        javascript:history.back();
    </script>";
} else {
    // Hash password sebelum disimpan
    $password = password_hash($password, PASSWORD_DEFAULT); 
    
    // Menyiapkan query untuk menambahkan data ketua
    $tambah = $koneksi->prepare("INSERT INTO tbl_ketua(id_ketua, no_ktp, nama, alamat, no_hp, username, password, id_admin) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $tambah->bind_param("ssssssss", $id_ketua, $no_ktp, $nama, $alamat, $no_hp, $username, $password, $id_admin);

    if ($tambah->execute()) {
        echo "<script>
                window.alert('Data Ketua Berhasil Ditambah!');
                window.location.href='../index.php?m=contents&p=listdataketua';
              </script>";
    } else {
        echo "<script> 
                alert('Data Tidak Lengkap & Valid');
                javascript:history.back();
              </script>";
    }
}
?>
