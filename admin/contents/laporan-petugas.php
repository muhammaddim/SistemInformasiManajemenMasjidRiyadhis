<?php
require "../../library/fpdf17/fpdf.php";
include "../../admin/functions.php";  // Pastikan path ini benar

if (isset($_POST['cetak'])) {
    $db = dbConnect();

    // Cek koneksi
    if ($db->connect_error) {
        die("Koneksi database gagal: " . $db->connect_error);
    }

    // Ambil data dari database
    $data = array();
    $sql = mysqli_query($db, "SELECT id_petugas, nama, no_ktp, alamat, no_hp FROM tbl_petugas"); 
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    // Judul dan header tabel
    $judul = "LAPORAN DATA PETUGAS";
    $header = array(
        array("label" => "ID", "length" => 30, "align" => "L"),
        array("label" => "Nama", "length" => 50, "align" => "L"),
        array("label" => "No KTP", "length" => 40, "align" => "L"),
        array("label" => "Alamat", "length" => 80, "align" => "L"),
        array("label" => "No HP", "length" => 35, "align" => "L")
    );

    // Inisialisasi FPDF
    $pdf = new FPDF('L', 'mm', 'A4'); // A4 = ukuran valid
    $pdf->AddPage();

    // Judul
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 15, $judul, 0, 1, 'C');
    $pdf->Ln(5);

    // Header tabel
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(100, 149, 237); // Warna biru muda
    $pdf->SetTextColor(255);           // Putih
    $pdf->SetDrawColor(50, 50, 100);   // Garis biru gelap
    foreach ($header as $kolom) {
        $pdf->Cell($kolom['length'], 7, $kolom['label'], 1, 0, $kolom['align'], true);
    }
    $pdf->Ln();

    // Data tabel
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 10);
    $fill = false;
    foreach ($data as $baris) {
        $i = 0;
        foreach ($baris as $cell) {
            $pdf->Cell($header[$i]['length'], 7, $cell, 1, 0, $header[$i]['align'], $fill);
            $i++;
        }
        $fill = !$fill;
        $pdf->Ln();
    }

    $pdf->Output();
} else {
    echo "<script>
        alert('Tidak Ada Data!');
        window.location.href = '../index.php?m=contents&p=laporan';
    </script>";
}
?>
