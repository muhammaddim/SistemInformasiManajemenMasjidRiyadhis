<?php
define('FPDF_FONTPATH','../../library/fpdf17/font/');
require "../../library/fpdf17/fpdf.php";
include "../../admin/functions.php";

// Cek jika font path telah didefinisikan
if (defined('FPDF_FONTPATH')) {
    $fontpath = FPDF_FONTPATH;
} else {
    // Tentukan jalur font yang benar
    $fontpath = dirname(__FILE__) . '/font/';
}

// Memastikan folder font ada
if (!is_dir($fontpath)) {
    die("Folder font tidak ditemukan. Pastikan folder font ada di: " . $fontpath);
}

class PDF extends FPDF {
    // Membuat header halaman
    function Header() {
        // Menentukan font, jika font tidak ada di folder font, gunakan font default
        try {
            $this->SetFont('Arial', 'B', 16);  // Menggunakan font Arial standar
        } catch (Exception $e) {
            $this->SetFont('Helvetica', 'B', 16);  // Ganti ke font Helvetica jika Arial tidak tersedia
        }

        $this->Cell(0, 20, 'Laporan Data Pegawai', 0, 1, 'C');
    }

    // Membuat footer halaman
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_POST['cetak'])) {
    $db = dbConnect();
    $data = array();
    $sql = mysqli_query($db, "SELECT id_petugas, nama, no_ktp, alamat, no_hp FROM tbl_petugas");
    while ($row = mysqli_fetch_assoc($sql)) {
        array_push($data, $row);
    }

    // Membuat PDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Menentukan font
    $pdf->SetFont('Arial', '', 12);

    // Membuat header tabel
    $header = array(
        array("label" => "ID", "length" => 15, "align" => 'L'),
        array("label" => "Nama", "length" => 50, "align" => 'L'),
        array("label" => "No KTP", "length" => 35, "align" => 'L'),
        array("label" => "Alamat", "length" => 65, "align" => 'L'),
        array("label" => "No HP", "length" => 28, "align" => 'L')
    );

    $pdf->SetFillColor(255, 0, 0);
    $pdf->SetTextColor(255);
    foreach ($header as $kolom) {
        $pdf->Cell($kolom['length'], 6, $kolom['label'], 1, 0, $kolom['align'], true);
    }
    $pdf->Ln();

    // Menampilkan data tabel
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(0);
    $fill = false;
    foreach ($data as $baris) {
        $i = 0;
        foreach ($baris as $cell) {
            $pdf->Cell($header[$i]['length'], 6, $cell, 1, 0, $header[$i]['align'], $fill);
            $i++;
        }
        $fill = !$fill;
        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output();
} else {
    echo "<script>window.alert('Tidak Ada Data!');
          window.location.href=('../index.php?m=contents&p=laporan')
          </script>";
}
?>
