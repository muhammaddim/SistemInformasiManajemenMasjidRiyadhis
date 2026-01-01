<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_masjid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get donation categories and their totals
function getDonationCategories($conn) {
    $categories = array();
    $sql = "SELECT k.id_kategori, k.nama_kategori, d.total 
            FROM tbl_kategori k
            JOIN tbl_dana d ON k.id_kategori = d.id_kategori
            ORDER BY k.nama_kategori";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

// Function to get upcoming events/agenda
function getUpcomingEvents($conn) {
    $events = array();
    $sql = "SELECT a.judul, a.tgl_awal, a.tgl_akhir, a.jam_awal, a.jam_akhir, a.keterangan, p.nama as nama_petugas 
            FROM tbl_agenda a
            JOIN tbl_petugas p ON a.id_petugas = p.id_petugas
            WHERE a.tgl_akhir >= CURDATE()
            ORDER BY a.tgl_awal ASC
            LIMIT 5";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    return $events;
}

// Function to get photo gallery
function getPhotoGallery($conn) {
    $photos = array();
    $sql = "SELECT a.file_name, a.tgl_upload, p.nama as uploader 
            FROM tbl_album a
            JOIN tbl_petugas p ON a.id_petugas = p.id_petugas
            ORDER BY a.tgl_upload DESC
            LIMIT 6";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $photos[] = $row;
        }
    }
    return $photos;
}

// Function to get mosque profile
function getMosqueProfile($conn) {
    $profile = array(
        'nama_masjid' => 'Masjid Jami Riyadhis',
        'alamat' => 'Jl. Raya Utama No. 123, Kota Cipadu',
        'tahun_berdiri' => '1995',
        'luas_bangunan' => '500 m²',
        'kapasitas' => '350 jamaah',
        'sejarah_singkat' => 'Masjid Jami riyadhis didirikan pada tahun 1995 oleh tokoh masyarakat setempat. Sejak berdiri, masjid ini telah menjadi pusat kegiatan keagamaan dan sosial bagi masyarakat sekitar. Masjid ini telah mengalami beberapa kali renovasi untuk memenuhi kebutuhan jamaah yang semakin bertambah.',
        'visi' => 'Menjadi pusat kegiatan keagamaan yang membina umat menuju masyarakat yang bertakwa dan berakhlak mulia.',
        'misi' => 'Menyelenggarakan kegiatan ibadah yang khusyuk, mengembangkan pendidikan Islam, meningkatkan syiar Islam, dan membangun kesejahteraan umat.',
        'ketua_dkm' => 'Dimyathi',
        'kontak' => '0812-3456-7890',
        'email' => 'jamiriya'
    );
    
    // Dalam implementasi sebenarnya, data ini sebaiknya diambil dari database
    // $sql = "SELECT * FROM tbl_profil_masjid LIMIT 1";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $profile = $result->fetch_assoc();
    // }
    
    return $profile;
}

// Function to get kajian schedule
function getKajianSchedule($conn) {
    $kajian = array(
        array(
            'judul' => 'Kajian Tafsir Al-Quran',
            'hari' => 'Senin',
            'waktu' => '19:30 - 21:00',
            'pemateri' => 'Ust. Ahmad Fadhil, Lc., MA.',
            'tema' => 'Memahami Kandungan Surah Al-Kahfi',
            'lokasi' => 'Ruang Utama Masjid'
        ),
        array(
            'judul' => 'Kajian Hadits Arbain',
            'hari' => 'Rabu',
            'waktu' => '19:30 - 21:00',
            'pemateri' => 'Ust. Muhammad Yusuf, S.Pd.I.',
            'tema' => 'Hadits-hadits Pilihan untuk Kehidupan Sehari-hari',
            'lokasi' => 'Ruang Utama Masjid'
        ),
        array(
            'judul' => 'Kajian Fiqih Muamalah',
            'hari' => 'Kamis',
            'waktu' => '19:30 - 21:00',
            'pemateri' => 'Ust. Dr. Zainuddin, M.Ag.',
            'tema' => 'Transaksi Ekonomi dalam Islam',
            'lokasi' => 'Ruang Serbaguna Lantai 2'
        ),
        array(
            'judul' => 'Kajian Khusus Muslimah',
            'hari' => 'Sabtu',
            'waktu' => '09:00 - 11:00',
            'pemateri' => 'Ustadzah Fatimah, S.Ag.',
            'tema' => 'Peran Wanita dalam Keluarga dan Masyarakat',
            'lokasi' => 'Ruang Muslimah'
        ),
        array(
            'judul' => 'Tahsin dan Tahfidz Al-Quran',
            'hari' => 'Minggu',
            'waktu' => '08:00 - 10:00',
            'pemateri' => 'Ust. Hafidz Abdurrahman',
            'tema' => 'Memperbaiki Bacaan dan Menghafal Al-Quran',
            'lokasi' => 'Ruang Utama Masjid'
        )
    );
    
    // Dalam implementasi sebenarnya, data ini sebaiknya diambil dari database
    // $kajian = array();
    // $sql = "SELECT * FROM tbl_jadwal_kajian ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //         $kajian[] = $row;
    //     }
    // }
    
    return $kajian;
}

// Function to get prayer times
function getPrayerTimes($conn) {
    // Data jadwal shalat (statis untuk contoh)
    // Dalam implementasi sebenarnya, bisa menggunakan API seperti Aladhan API
    // atau menyimpan jadwal di database yang diupdate secara berkala
    
    $now = new DateTime();
    $month = $now->format('n');
    $year = $now->format('Y');
    
    $prayer_times = array(
        'date' => date('d M Y'),
        'fajr' => '04:30',
        'sunrise' => '05:50',
        'dhuhr' => '12:05',
        'asr' => '15:20',
        'maghrib' => '18:10',
        'isha' => '19:25'
    );
    
    // Dalam implementasi sebenarnya, data ini sebaiknya diambil dari database atau API
    // $date = date('Y-m-d');
    // $sql = "SELECT * FROM tbl_jadwal_shalat WHERE tanggal = '$date'";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $prayer_times = $result->fetch_assoc();
    // }
    
    return $prayer_times;
}

// Get data
$categories = getDonationCategories($conn);
$events = getUpcomingEvents($conn);
$photos = getPhotoGallery($conn);
$mosqueProfile = getMosqueProfile($conn);
$kajianSchedule = getKajianSchedule($conn);
$prayerTimes = getPrayerTimes($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Masjid <?php echo htmlspecialchars($mosqueProfile["nama_masjid"]); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #075e54;
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background-color: #075e54;
            color: white;
            font-weight: bold;
        }
        .donation-category {
            border-left: 4px solid #075e54;
            padding-left: 10px;
            margin-bottom: 10px;
        }
        .event-item {
            border-bottom: 1px solid #e9ecef;
            padding: 10px 0;
        }
        .event-item:last-child {
            border-bottom: none;
        }
        .photo-gallery img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .footer {
            background-color: #075e54;
            color: white;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }
        .prayer-time-box {
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #075e54;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .prayer-time-name {
            font-weight: bold;
            color: #075e54;
        }
        .kajian-item {
            border-bottom: 1px solid #e9ecef;
            padding: 10px 0;
        }
        .kajian-item:last-child {
            border-bottom: none;
        }
        .profile-detail {
            margin-bottom: 15px;
        }
        .nav-pills .nav-link.active {
            background-color: #075e54;
        }
        .nav-pills .nav-link {
            color: #075e54;
        }
        .tab-pane {
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <h1><i class="fas fa-mosque"></i> <?php echo htmlspecialchars($mosqueProfile["nama_masjid"]); ?></h1>
            <p>Menyediakan informasi terkait kegiatan dan dana masjid</p>
        </div>
    </div>
    
    <div class="container">
        <!-- Jadwal Shalat -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-clock"></i> Jadwal Shalat Hari Ini - <?php echo $prayerTimes['date']; ?>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Subuh</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['fajr']; ?></div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Terbit</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['sunrise']; ?></div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Dzuhur</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['dhuhr']; ?></div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Ashar</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['asr']; ?></div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Maghrib</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['maghrib']; ?></div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 mb-3">
                        <div class="prayer-time-box">
                            <div class="prayer-time-name">Isya</div>
                            <div class="prayer-time-value"><?php echo $prayerTimes['isha']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Masjid dan Jadwal Kajian/Pengajian -->
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                            <i class="fas fa-info-circle"></i> Profil Masjid
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kajian-tab" data-bs-toggle="tab" data-bs-target="#kajian" type="button" role="tab" aria-controls="kajian" aria-selected="false">
                            <i class="fas fa-book-reader"></i> Jadwal Pengajian
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="profileTabsContent">
                    <!-- Tab Profile Masjid -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-3">Informasi Umum</h4>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-mosque"></i> Nama Masjid:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["nama_masjid"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-map-marker-alt"></i> Alamat:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["alamat"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-calendar-alt"></i> Tahun Berdiri:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["tahun_berdiri"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-ruler-combined"></i> Luas Bangunan:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["luas_bangunan"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-users"></i> Kapasitas Jamaah:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["kapasitas"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-user-tie"></i> Ketua DKM:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["ketua_dkm"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-phone"></i> Kontak:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["kontak"]); ?>
                                </div>
                                <div class="profile-detail">
                                    <strong><i class="fas fa-envelope"></i> Email:</strong> 
                                    <?php echo htmlspecialchars($mosqueProfile["email"]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-3">Sejarah Singkat</h4>
                                <p><?php echo htmlspecialchars($mosqueProfile["sejarah_singkat"]); ?></p>
                                
                                <h4 class="mb-3">Visi</h4>
                                <p><?php echo htmlspecialchars($mosqueProfile["visi"]); ?></p>
                                
                                <h4 class="mb-3">Misi</h4>
                                <p><?php echo htmlspecialchars($mosqueProfile["misi"]); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab Jadwal Kajian -->
                    <div class="tab-pane fade" id="kajian" role="tabpanel" aria-labelledby="kajian-tab">
                        <h4 class="mb-3 text-center">Jadwal Kajian/Pengajian Rutin</h4>
                        
                        <?php if (count($kajianSchedule) > 0): ?>
                            <?php foreach($kajianSchedule as $kajian): ?>
                                <div class="kajian-item">
                                    <h5><?php echo htmlspecialchars($kajian["judul"]); ?></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><i class="fas fa-calendar-day"></i> <strong>Hari:</strong> <?php echo htmlspecialchars($kajian["hari"]); ?></p>
                                            <p><i class="fas fa-clock"></i> <strong>Waktu:</strong> <?php echo htmlspecialchars($kajian["waktu"]); ?> WIB</p>
                                            <p><i class="fas fa-map-pin"></i> <strong>Lokasi:</strong> <?php echo htmlspecialchars($kajian["lokasi"]); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><i class="fas fa-user-tie"></i> <strong>Pemateri:</strong> <?php echo htmlspecialchars($kajian["pemateri"]); ?></p>
                                            <p><i class="fas fa-book-open"></i> <strong>Tema:</strong> <?php echo htmlspecialchars($kajian["tema"]); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Belum ada jadwal kajian yang diinputkan</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Dana Masjid -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-hand-holding-usd"></i> Dana Masjid
                    </div>
                    <div class="card-body">
                        <?php if (count($categories) > 0): ?>
                            <?php foreach($categories as $category): ?>
                                <div class="donation-category">
                                    <h5><?php echo htmlspecialchars($category["nama_kategori"]); ?></h5>
                                    <p>Total Dana: <strong>Rp <?php echo number_format($category["total"], 0, ',', '.'); ?></strong></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Belum ada data dana masjid</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Agenda Kegiatan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-calendar-alt"></i> Agenda Kegiatan Mendatang
                    </div>
                    <div class="card-body">
                        <?php if (count($events) > 0): ?>
                            <?php foreach($events as $event): ?>
                                <div class="event-item">
                                    <h5><?php echo htmlspecialchars($event["judul"]); ?></h5>
                                    <p>
                                        <i class="far fa-calendar"></i> 
                                        <?php 
                                            $tgl_awal = date("d M Y", strtotime($event["tgl_awal"]));
                                            $tgl_akhir = date("d M Y", strtotime($event["tgl_akhir"]));
                                            if ($tgl_awal == $tgl_akhir) {
                                                echo $tgl_awal;
                                            } else {
                                                echo $tgl_awal . " - " . $tgl_akhir;
                                            }
                                        ?>
                                    </p>
                                    <p>
                                        <i class="far fa-clock"></i> 
                                        <?php 
                                            echo date("H:i", strtotime($event["jam_awal"])) . " - " . 
                                                 date("H:i", strtotime($event["jam_akhir"])); 
                                        ?> WIB
                                    </p>
                                    <p><?php echo htmlspecialchars($event["keterangan"]); ?></p>
                                    <p class="text-muted"><small>Penanggung Jawab: <?php echo htmlspecialchars($event["nama_petugas"]); ?></small></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Belum ada agenda kegiatan mendatang</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Galeri Foto -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-images"></i> Galeri Foto
            </div>
            <div class="card-body">
                <div class="row photo-gallery">
                    <?php if (count($photos) > 0): ?>
                        <?php foreach($photos as $photo): ?>
                            <div class="col-md-4 col-sm-6">
                                <img src="uploads/<?php echo htmlspecialchars($photo["file_name"]); ?>" alt="Foto Masjid" class="img-fluid">
                                <p class="text-muted">
                                    <small>Diupload pada: <?php echo date("d M Y", strtotime($photo["tgl_upload"])); ?></small><br>
                                    <small>Oleh: <?php echo htmlspecialchars($photo["uploader"]); ?></small>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada foto yang diupload</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Tombol Bantuan -->
        <div class="text-center mt-4 mb-4">
            <a href="#" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#donationModal">
                <i class="fas fa-donate"></i> Donasi Sekarang
            </a>
        </div>
    </div>
    
    <!-- Modal Donasi -->
    <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="donationModalLabel">Donasi untuk Masjid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Silakan transfer donasi Anda ke rekening berikut:</p>
                    
                    <div class="alert alert-info">
                        <p><strong>Bank:</strong> BNI</p>
                        <p><strong>No. Rekening:</strong> 601004235</p>
                        <p><strong>Atas Nama:</strong> DIMYATHI</p>
                    </div>
                    
                    <p>Atau Anda dapat login untuk melakukan donasi secara online melalui sistem kami.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="admin.php" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Donasi
                        </a>
                        <a href="register.php" class="btn btn-secondary">
                            <i class="fas fa-user-plus"></i> Daftar Akun Baru
                        </a>
                        <a href="administrator.php" class="btn btn-secondary">
                            <i class="fas fa-user-plus"></i> Login Admin,Petugas,Dan Ketua
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> Sistem Informasi <?php echo htmlspecialchars($mosqueProfile["nama_masjid"]); ?>. Semua hak dilindungi.</p>
        </div>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>