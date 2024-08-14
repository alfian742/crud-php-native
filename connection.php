<?php
$db_hostname    = 'localhost';
$db_username    = 'root';
$db_password    = '';
$db_name        = 'database';

$koneksi = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$koneksi) {
    echo "Terjadi kesalahan! Koneksi ke basis data tidak dapat dilakukan.\n" . mysqli_connect_error($koneksi);
    exit();
}
