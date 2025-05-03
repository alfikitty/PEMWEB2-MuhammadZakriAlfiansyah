<?php
require_once '../dbkoneksi.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Fetch periksa details with related data
$sql = "SELECT p.*, ps.nama as pasien_nama, d.nama as dokter_nama 
        FROM periksa p 
        LEFT JOIN pasien ps ON p.pasien_id = ps.id 
        LEFT JOIN paramedik d ON p.dokter_id = d.id 
        WHERE p.id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id]);
$periksa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$periksa) {
    echo "Record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pemeriksaan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Pemeriksaan Details</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Pemeriksaan Information</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['id'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                    <dd class="text-sm text-gray-900"><?= date('d-m-Y', strtotime($periksa['tanggal'])) ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Pasien</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['pasien_nama'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Dokter</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['dokter_nama'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Berat</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['berat'] ? $periksa['berat'] . ' kg' : '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Tinggi</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['tinggi'] ? $periksa['tinggi'] . ' cm' : '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Tekanan Darah</dt>
                    <dd class="text-sm text-gray-900"><?= $periksa['tensi'] ?: '-' ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                    <dd class="text-sm text-gray-900 col-span-2"><?= $periksa['keterangan'] ?: '-' ?></dd>
                </dl>
            </div>
        </div>
        
        <div class="flex space-x-4">
            <a href="form.php?id=<?= $periksa['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Edit Pemeriksaan</a>
            <a href="process.php?action=delete&id=<?= $periksa['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this record?')">Delete Pemeriksaan</a>
        </div>
    </div>
</body>
</html>