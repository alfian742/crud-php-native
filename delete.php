<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['warning'] = "Halaman tidak dapat diakses. Silahkan masuk!";
    header('Location: login.php');
    exit();
}

include('connection.php');

if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];

    $cek_foto = mysqli_query($koneksi, "SELECT foto FROM penduduk WHERE nik='$nik'");
    if ($cek_foto && mysqli_num_rows($cek_foto) > 0) {
        $foto_lama = mysqli_fetch_array($cek_foto)['foto'];
        if ($foto_lama && file_exists('uploads/img/' . $foto_lama)) {
            unlink('uploads/img/' . $foto_lama);
        }
    }

    $sql = "DELETE FROM penduduk WHERE nik='$nik'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        $_SESSION['success'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Data gagal dihapus! " . mysqli_error($koneksi);
    }

    header('Location: show.php');
    exit();
} else {
    header('Location: show.php');
    exit();
}
