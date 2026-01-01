<?php
include "koneksidb.php";
session_start();

if (isset($_POST["LoginKetua"])) {
    if (!empty($_POST["username_ketua"]) && !empty($_POST["password_ketua"])) {
        $username = $_POST["username_ketua"];
        $pass = $_POST["password_ketua"];

        // Gunakan prepared statement agar lebih aman dari SQL injection
        $stmt = $mysqli->prepare("SELECT username_ketua, password_ketua FROM tbl_ketua WHERE username_ketua = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $data = $res->fetch_assoc();

            // Verifikasi password dengan hash
            if (password_verify($pass, $data["password_ketua"])) {
                $_SESSION["username_ketua"] = $data["username_ketua"];
                header("Location: ketua/index.php");
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Username tidak ditemukan!";
        }

        $stmt->close();
    } else {
        echo "Harap isi semua kolom!";
    }
}
?>
