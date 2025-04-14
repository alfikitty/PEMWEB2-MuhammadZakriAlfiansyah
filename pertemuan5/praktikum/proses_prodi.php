<?php
require_once 'dbkoneksi.php';

// 1) tangkap data dari form
$_kode = $_POST['kode'];
$_nama = $_POST['nama'];
$kaprodi = $_POST['kaprodi'];
$_proses = $_POST['proses'];

// buat array data
$ar_data = [$_kode, $_nama, $kaprodi];
// buat query
if ($_proses == "Simpan"){
    $sql = "INSERT INTO prodi(kode, nama, kaprodi) VALUES(?,?,?)";
}elseif($_proses == "Update"){
    $id_edit = $_POST['id_edit'];//4
    $ar_data[] = $id_edit;
    $sql = UPDATE prodi SET nama=?, kaprodi=? WHERE kode=?";
}elseif ($_proses == "Hapus"){
    $id_hapus = $_POST['id_hapus'];
    $ar_data = [$id_kode];
    $sql = DELETE FROM prodi WHERE kode=?";
}
// 5) buat statement 
$stmt = $dbh->prepare($sql);
// 6) jalankan query
$stmt->execute($ar_data);
// redirect ke halaman list_mahasiswa.php
header('location:list_prodi.php');
?>