<?php  
include_once "database.php";

// Ambil data dari form
$id_ketua = $_POST['id_ketua'];
$nama_ketua = $_POST['nama_ketua'];
$alamat = $_POST['alamat_ketua'];
$no_hp = str_replace(" ", "", $_POST['nohp_ketua']);
$username = $_POST['username_ketua'];
$password = $_POST['password_ketua'];
$password2 = $_POST['password2_ketua'];

// Validasi jika password dan konfirmasi password tidak cocok
if ($password !== $password2) {
    echo "<script> 
            alert('Konfirmasi password tidak sesuai');
            javascript:history.back();
          </script>";
} else {
    // Enkripsi password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ketua ke database
    $query = "INSERT INTO tbl_ketua (id_ketua, nama_ketua, alamat_ketua, nohp_ketua, username_ketua, password_ketua) 
              VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("ssssss", $id_ketua, $nama_ketua, $alamat, $no_hp, $username, $password_hashed);
        
        if ($stmt->execute()) {
            echo "<script>
                    alert('Data Ketua Berhasil Ditambahkan!');
                    window.location.href='../index.php?m=contents&p=listdataketua';
                  </script>";
        } else {
            echo "<script> 
                    alert('Terjadi kesalahan saat menyimpan data');
                    javascript:history.back();
                  </script>";
        }
    } else {
        echo "<script> 
                alert('Terjadi kesalahan pada query');
                javascript:history.back();
              </script>";
    }
}
?>
