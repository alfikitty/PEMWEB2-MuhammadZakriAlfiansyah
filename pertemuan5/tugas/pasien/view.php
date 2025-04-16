<?php
require_once '../dbkoneksi.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Fetch pasien details with related data
$sql = "SELECT p.*, k.nama as kelurahan_nama
        FROM pasien p 
        LEFT JOIN kelurahan k ON p.kelurahan_id = k.id 
        WHERE p.id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id]);
$pasien = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pasien) {
    echo "Record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pasien</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Pasien Details</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Pasien Information</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['id'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Kode</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['kode'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['nama'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['tmp_lahir'] ?: '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['tgl_lahir'] ? date('d-m-Y', strtotime($pasien['tgl_lahir'])) : '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Gender</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['email'] ?: '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['alamat'] ?: '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Kelurahan</dt>
                    <dd class="text-sm text-gray-900"><?= $pasien['kelurahan_nama'] ?></dd>
                    
                </dl>
            </div>
        </div>
        
        <div class="flex space-x-4">
            <a href="form.php?id=<?= $pasien['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Edit Pasien</a>
            <a href="process.php?action=delete&id=<?= $pasien['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this record?')">Delete Pasien</a>
        </div>
    </div>
</body>
</html>