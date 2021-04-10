<?php
// panggil file config.php untuk koneksi ke database
require_once "config/config.php";
// jika tombol simpan diklik
if (isset($_GET['no_reg'])) {
    // ambil data get dari form 
    $reg = $_GET['no_reg'];

    $delete = $mysqli->query("DELETE FROM pegawai WHERE no_reg='$reg'")
                              or die('Ada kesalahan pada query delete : '.$mysqli->error);
    // cek hasil query
    if ($delete) {
        // jika berhasil tampilkan pesan berhasil delete data
        header("location: index.php?alert=3");
    }
}
// tutup koneksi
$mysqli->close();   
?>