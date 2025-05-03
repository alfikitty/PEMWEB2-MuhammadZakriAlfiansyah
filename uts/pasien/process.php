<?php
require_once '../dbkoneksi.php';

// Get the action
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        // Get form data
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $tmp_lahir = $_POST['tmp_lahir'] ?: null;
        $tgl_lahir = $_POST['tgl_lahir'] ?: null;
        $gender = $_POST['gender'];
        $email = $_POST['email'] ?: null;
        $alamat = $_POST['alamat'] ?: null;
        $kelurahan_id = $_POST['kelurahan_id'];
        
        // Check if kode already exists
        $sql_check = "SELECT COUNT(*) FROM pasien WHERE kode = ?";
        $stmt_check = $dbh->prepare($sql_check);
        $stmt_check->execute([$kode]);
        if ($stmt_check->fetchColumn() > 0) {
            header('Location: index.php?status=error&message=Kode already exists');
            exit;
        }
        
        // Insert new record
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id]);
            header('Location: index.php?status=created');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'update':
        // Get form data
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $tmp_lahir = $_POST['tmp_lahir'] ?: null;
        $tgl_lahir = $_POST['tgl_lahir'] ?: null;
        $gender = $_POST['gender'];
        $email = $_POST['email'] ?: null;
        $alamat = $_POST['alamat'] ?: null;
        $kelurahan_id = $_POST['kelurahan_id'];
        
        // Check if kode already exists (excluding current record)
        $sql_check = "SELECT COUNT(*) FROM pasien WHERE kode = ? AND id != ?";
        $stmt_check = $dbh->prepare($sql_check);
        $stmt_check->execute([$kode, $id]);
        if ($stmt_check->fetchColumn() > 0) {
            header('Location: index.php?status=error&message=Kode already exists');
            exit;
        }
        
        // Update record
        $sql = "UPDATE pasien 
                SET kode = ?, nama = ?, tmp_lahir = ?, tgl_lahir = ?, gender = ?, 
                    email = ?, alamat = ?, kelurahan_id = ?
                WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id, $id]);
            header('Location: index.php?status=updated');
        } catch (PDOException $e) {
            header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
        }
        break;
        
    case 'delete':
        // Get ID
        $id = $_GET['id'];
        
        // Delete record
        $sql = "DELETE FROM pasien WHERE id = ?";
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