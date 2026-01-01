<?php
include "database.php";

// Atur ukuran maksimal upload (jika belum disetel di php.ini)
ini_set('upload_max_filesize', '10M'); // Maksimum 10MB
ini_set('post_max_size', '12M');

session_start();

if (isset($_POST['kirim'])) {
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file_asli = $_FILES['fupload']['name'];
    $ukuran_file = $_FILES['fupload']['size'];
    $idpetugas = $_SESSION['id_petugas'];
    $tgl = date('Ymd');

    // Sanitasi nama file
    $nama_file = preg_replace("/[^A-Za-z0-9_\-\.]/", "_", basename($nama_file_asli));
    $nama_file = time() . "_" . $nama_file;

    // Validasi ekstensi
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed_ext)) {
        echo "<script>alert('Jenis file tidak didukung!'); window.location.href='../index.php?m=contents&p=album';</script>";
        exit;
    }

    // Validasi ukuran file maksimal 10MB
    if ($ukuran_file > 10 * 1024 * 1024) {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 10MB'); window.location.href='../index.php?m=contents&p=album';</script>";
        exit;
    }

    $folder = "files/$nama_file";

    if (move_uploaded_file($lokasi_file, $folder)) {
        // Gunakan prepared statement
        $stmt = $koneksi->prepare("INSERT INTO tbl_album (id_petugas, file_name, tgl_upload) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $idpetugas, $nama_file, $tgl);
        $stmt->execute();

        echo "<script>alert('Berhasil diunggah!'); window.location.href='../index.php?m=contents&p=album';</script>";
    } else {
        echo "<script>alert('Gagal mengunggah file!'); window.location.href='../index.php?m=contents&p=album';</script>";
    }
}

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $stmt = $koneksi->prepare("DELETE FROM tbl_album WHERE id_album = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>window.location.href='index.php?m=contents&p=album';</script>";
}
?>
