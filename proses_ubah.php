<?php
// panggil file config.php untuk koneksi ke database
require_once "config/config.php";
// jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    if (isset($_POST['no_reg'])) {
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
        
        // perintah query untuk mengubah data pada tabel pegawai
        $update = $mysqli->query("UPDATE pegawai SET nama_pasien        = '$nama_pasien',
                                                        tempat_lahir    = '$tempat_lahir',
                                                        tanggal_lahir   = '$tanggal_lahir',
                                                        jenis_kelamin   = '$jenis_kelamin',
                                                        keluhan         = '$keluhan',
                                                        alamat          = '$alamat',
                                                        no_hp           = '$no_hp',
                                                        terapy          = '$terapy'
                                                WHERE no_reg            = '$no_regis'")
                                    or die('Ada kesalahan pada query update : '.$mysqli->error);
        // cek query
        if ($update) {
            // jika berhasil tampilkan pesan berhasil ubah data
            header("location: index.php?alert=2");
        }
    }
}
// tutup koneksi
$mysqli->close();   
?>