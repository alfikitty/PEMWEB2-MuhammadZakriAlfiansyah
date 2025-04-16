<?php
require_once '../dbkoneksi.php';

// Initialize variables
$id = '';
$tanggal = date('Y-m-d'); // Default to today
$berat = '';
$tinggi = '';
$tensi = '';
$keterangan = '';
$pasien_id = '';
$dokter_id = '';
$form_action = 'create';

// Check if we're editing an existing record
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $form_action = 'update';
    
    // Fetch the record
    $sql = "SELECT * FROM periksa WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $tanggal = $row['tanggal'];
        $berat = $row['berat'];
        $tinggi = $row['tinggi'];
        $tensi = $row['tensi'];
        $keterangan = $row['keterangan'];
        $pasien_id = $row['pasien_id'];
        $dokter_id = $row['dokter_id'];
    } else {
        echo "Record not found.";
        exit;
    }
}

// Fetch pasien for dropdown
$sql_pasien = "SELECT * FROM pasien ORDER BY nama";
$rs_pasien = $dbh->query($sql_pasien);

// Fetch dokter for dropdown (only dokter category from paramedik)
$sql_dokter = "SELECT * FROM paramedik WHERE kategori = 'dokter' ORDER BY nama";
$rs_dokter = $dbh->query($sql_dokter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $form_action == 'create' ? 'Add' : 'Edit' ?> Pemeriksaan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold"><?= $form_action == 'create' ? 'Add New' : 'Edit' ?> Pemeriksaan</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="<?= $form_action ?>">
                <?php if ($form_action == 'update'): ?>
                <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= $tanggal ?>" required
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="pasien_id" class="block text-sm font-medium text-gray-700">Pasien</label>
                    <select id="pasien_id" name="pasien_id" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                        <option value="">-- Pilih Pasien --</option>
                        <?php while ($pasien = $rs_pasien->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $pasien['id'] ?>" <?= $pasien_id == $pasien['id'] ? 'selected' : '' ?>>
                            <?= $pasien['nama'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="dokter_id" class="block text-sm font-medium text-gray-700">Dokter</label>
                    <select id="dokter_id" name="dokter_id" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                        <option value="">-- Pilih Dokter --</option>
                        <?php while ($dokter = $rs_dokter->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $dokter['id'] ?>" <?= $dokter_id == $dokter['id'] ? 'selected' : '' ?>>
                            <?= $dokter['nama'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="berat" class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                    <input type="number" id="berat" name="berat" value="<?= $berat ?>" step="0.1"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="tinggi" class="block text-sm font-medium text-gray-700">Tinggi (cm)</label>
                    <input type="number" id="tinggi" name="tinggi" value="<?= $tinggi ?>" step="0.1"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="tensi" class="block text-sm font-medium text-gray-700">Tekanan Darah</label>
                    <input type="text" id="tensi" name="tensi" value="<?= $tensi ?>" placeholder="e.g. 120/80"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"><?= $keterangan ?></textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        <?= $form_action == 'create' ? 'Create' : 'Update' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>