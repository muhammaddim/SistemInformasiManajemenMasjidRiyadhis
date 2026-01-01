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

// FIX PENTING DI SINI!
$target_dir = __DIR__ . "/petugas/library/files/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$folder = $target_dir . $nama_file;

if (move_uploaded_file($lokasi_file, $folder)) {
    $stmt = $koneksi->prepare("INSERT INTO tbl_album (id_petugas, file_name, tgl_upload) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $idpetugas, $nama_file, $tgl);
    $stmt->execute();

    echo "<script>alert('Berhasil diunggah!'); window.location.href='../index.php?m=contents&p=album';</script>";
} else {
    echo "<script>alert('Gagal mengunggah file!'); window.location.href='../index.php?m=contents&p=album';</script>";
}
