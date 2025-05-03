<?php
require_once '../dbkoneksi.php';

// Get the action
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        // Get form data
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $tmp_lahir = $_POST['tmp_lahir'] ?: null;
        $tgl_lahir = $_POST['tgl_lahir'] ?: null;
        $kategori = $_POST['kategori'];
        $telpon = $_POST['telpon'] ?: null;
        $alamat = $_POST['alamat'] ?: null;
        $unit_kerja_id = $_POST['unit_kerja_id'];
        
        // Insert new record
        $sql = "INSERT INTO paramedik (nama, gender, tmp_lahir, tgl_lahir, kategori, telpon, alamat, unit_kerja_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telpon, $alamat, $unit_kerja_id]);
            header('Location: index.php?status=created');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'update':
        // Get form data
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $tmp_lahir = $_POST['tmp_lahir'] ?: null;
        $tgl_lahir = $_POST['tgl_lahir'] ?: null;
        $kategori = $_POST['kategori'];
        $telpon = $_POST['telpon'] ?: null;
        $alamat = $_POST['alamat'] ?: null;
        $unit_kerja_id = $_POST['unit_kerja_id'];
        
        // Update record
        $sql = "UPDATE paramedik 
                SET nama = ?, gender = ?, tmp_lahir = ?, tgl_lahir = ?, 
                    kategori = ?, telpon = ?, alamat = ?, unit_kerja_id = ? 
                WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telpon, $alamat, $unit_kerja_id, $id]);
            header('Location: index.php?status=updated');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'delete':
        // Get ID
        $id = $_GET['id'];
        
        // Delete record
        $sql = "DELETE FROM paramedik WHERE id = ?";
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