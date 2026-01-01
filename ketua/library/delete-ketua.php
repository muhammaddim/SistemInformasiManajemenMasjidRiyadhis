<?php
session_start();
include_once "library/database.php";

// Cek jika id_ketua ada
if (isset($_GET['id_ketua'])) {
    $id_ketua = $_GET['id_ketua'];

    // Query untuk menghapus data ketua
    $query = "DELETE FROM tbl_ketua WHERE id_ketua = '$id_ketua'";

    if ($koneksi->query($query)) {
        echo "<script>
                alert('Data ketua berhasil dihapus!');
                window.location.href = 'index.php?m=contents&p=listdataketua';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan, coba lagi!');
              </script>";
    }
} else {
    echo "<script>
            alert('ID Ketua tidak ditemukan!');
            window.location.href = 'index.php?m=contents&p=listdataketua';
          </script>";
}
?>
