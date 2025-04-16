<?php
require_once '../dbkoneksi.php';

// Get the action
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'create':
        // Get form data
        $nama = $_POST['nama'];
        
        // Insert new record
        $sql = "INSERT INTO unit_kerja (nama) VALUES (?)";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama]);
            header('Location: index.php?status=created');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
        
    case 'update':
        // Get form data
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        
        // Update record
        $sql = "UPDATE unit_kerja SET nama = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute([$nama, $id]);
            header('Location: index.php?status=updated');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
        
    case 'delete':
        // Get ID
        $id = $_GET['id'];
        
        // Delete record
        $sql = "DELETE FROM unit_kerja WHERE id = ?";
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
