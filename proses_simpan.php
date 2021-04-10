<?php
// panggil file config.php untuk koneksi ke database
require_once "config/config.php";
// jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $no_regis           = $mysqli->real_escape_string(trim($_POST['no_reg']));
    $nama_pasien       = $mysqli->real_escape_string(trim($_POST['nama_pasien']));
    $tempat_lahir       = $mysqli->real_escape_string(trim($_POST['tempat_lahir']));
    $tanggal_lahir      = $mysqli->real_escape_string(trim(date('Y-m-d', strtotime($_POST['tanggal_lahir']))));
    $jenis_kelamin      = $mysqli->real_escape_string(trim($_POST['jenis_kelamin']));
    $keluhan            = $mysqli->real_escape_string(trim($_POST['keluhan_pasien']));
    $alamat             = $mysqli->real_escape_string(trim($_POST['alamat']));
    $no_hp              = $mysqli->real_escape_string(trim($_POST['no_hp']));
    $terapy             = $mysqli->real_escape_string(trim($_POST['terapy']));
    $hari_ini           = date('Y-m-d');
    // $nama_file          = $_FILES['foto']['name'];
    // $tmp_file           = $_FILES['foto']['tmp_name'];
    // Set path folder tempat menyimpan filenya
    // $path               = "foto/".$nama_file;

    // perintah query untuk mengecek nip
    $result = $mysqli->query("SELECT no_reg FROM pegawai WHERE no_reg='$no_regis'")
                              or die('Ada kesalahan pada query tampil data No Reg: '.$mysqli->error);
    $rows = $result->num_rows;
    // jika nip sudah ada
    if ($rows > 0) {
        // tampilkan pesan gagal simpan data
        header("location: index.php?alert=4&no_reg=$no_regis");
    }
    // jika nip belum ada
    else {  
        // upload file
        // if(move_uploaded_file($tmp_file, $path)) {
            // Jika file berhasil diupload, Lakukan : 
            // perintah query untuk menyimpan data ke tabel pegawai
            $insert = $mysqli->query("INSERT INTO pegawai(no_reg,nama_pasien,tempat_lahir,tanggal_lahir,jenis_kelamin,keluhan,alamat,terapy,no_hp,tanggal_regis)
                                      VALUES('$no_regis','$nama_pasien','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$keluhan','$alamat','$terapy','$no_hp','$hari_ini')")
                                      or die('Ada kesalahan pada query insert : '.$mysqli->error); 
            // cek query
            if ($insert) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: index.php?alert=1");
            }   
        // }
    }
}
// tutup koneksi
$mysqli->close();   
?>