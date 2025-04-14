<?php
require_once '../dbkoneksi.php';

// Get the action
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        // Get form data
        $nama = $_POST['nama'];
        $kec_id = $_POST['kec_id'];
        
        // Insert new record
        $sql = "INSERT INTO kelurahan (nama, kec_id) VALUES (?, ?)";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama, $kec_id]);
            header('Location: index.php?status=created');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
        
    case 'update':
        // Get form data
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kec_id = $_POST['kec_id'];
        
        // Update record
        $sql = "UPDATE kelurahan SET nama = ?, kec_id = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama, $kec_id, $id]);
            header('Location: index.php?status=updated');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
        
    case 'delete':
        // Get ID
        $id = $_GET['id'];
        
        // Check if kelurahan has associated patients
        $sql = "SELECT COUNT(*) FROM pasien WHERE kelurahan_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            header('Location: index.php?status=error&message=Cannot delete kelurahan with associated patients');
            exit;
        }
        
        // Delete record
        $sql = "DELETE FROM kelurahan WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$id]);
            header('Location: index.php?status=deleted');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
        
    default:
        // Redirect to index if no valid action
        header('Location: index.php');
        break;
}
?>