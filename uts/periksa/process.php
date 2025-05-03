<?php
require_once '../dbkoneksi.php';

// Get the action
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        // Get form data
        $tanggal = $_POST['tanggal'];
        $berat = $_POST['berat'] !== '' ? $_POST['berat'] : null;
        $tinggi = $_POST['tinggi'] !== '' ? $_POST['tinggi'] : null;
        $tensi = $_POST['tensi'] ?: null;
        $keterangan = $_POST['keterangan'] ?: null;
        $pasien_id = $_POST['pasien_id'];
        $dokter_id = $_POST['dokter_id'];
        
        // Insert new record
        $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$tanggal, $berat, $tinggi, $tensi, $keterangan, $pasien_id, $dokter_id]);
            header('Location: index.php?status=created');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'update':
        // Get form data
        $id = $_POST['id'];
        $tanggal = $_POST['tanggal'];
        $berat = $_POST['berat'] !== '' ? $_POST['berat'] : null;
        $tinggi = $_POST['tinggi'] !== '' ? $_POST['tinggi'] : null;
        $tensi = $_POST['tensi'] ?: null;
        $keterangan = $_POST['keterangan'] ?: null;
        $pasien_id = $_POST['pasien_id'];
        $dokter_id = $_POST['dokter_id'];
        
        // Update record
        $sql = "UPDATE periksa 
                SET tanggal = ?, berat = ?, tinggi = ?, tensi = ?, 
                    keterangan = ?, pasien_id = ?, dokter_id = ? 
                WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$tanggal, $berat, $tinggi, $tensi, $keterangan, $pasien_id, $dokter_id, $id]);
            header('Location: index.php?status=updated');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'delete':
        // Get ID
        $id = $_GET['id'];
        
        // Delete record
        $sql = "DELETE FROM periksa WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$id]);
            header('Location: index.php?status=deleted');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    default:
        // Redirect to index if no valid action
        header('Location: index.php');
        break;
}
?>