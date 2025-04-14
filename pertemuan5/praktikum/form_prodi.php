<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Program Studi</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .container {
            @apply mx-auto p-4;
        }
        .mb-3 {
            @apply mb-3;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700;
        }
        .form-control {
            @apply mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500;
        }
        .btn-primary {
            @apply bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded;
        }
        .btn-danger {
            @apply bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded;
        }
        .btn-warning {
            @apply bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded;
        }
    </style>
</head>
<body>
<div class="container mx-auto p-4 mt-5">
    <h2 class="text-center mb-4 text-2xl font-bold">Form Program Studi</h2>
    
    <?php
    require_once 'dbkoneksi.php';
    
    // Initialize variables
    $id = "";
    $kode = "";
    $nama = "";
    $kaprodi = "";
    $process_type = "Simpan";
    
    // Check if we're editing an existing record
    if(isset($_GET['id_edit'])) {
        $id_edit = $_GET['id_edit'];
        $process_type = "Update";
        
        // Get the record data
        $sql = "SELECT * FROM prodi WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id_edit]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $id = $row['id'];
            $kode = $row['kode'];
            $nama = $row['nama'];
            $kaprodi = $row['kaprodi'];
        }
    }
    ?>
    
    <form action="proses_prodi.php" method="POST" class="space-y-4">
        <input type="hidden" name="id_edit" value="<?= $id ?>">
        
        <div>
            <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" id="kode" name="kode" value="<?= $kode ?>" >
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" id="nama" name="nama" value="<?= $nama ?>" >
        </div>
        <div>
            <label for="kaprodi" class="block text-sm font-medium text-gray-700">Kaprodi</label>
            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" id="kaprodi" name="kaprodi" value="<?= $kaprodi ?>" >
        </div>
        
        <div class="flex gap-2">
            <button name="proses" value="<?= $process_type ?>" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                <?= $process_type ?>
            </button>
            
            <?php if($process_type == "Update"): ?>
                <a href="prodi.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md inline-block">
                    Batal
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php include "list_prodi.php" ?>

</body>
</html>