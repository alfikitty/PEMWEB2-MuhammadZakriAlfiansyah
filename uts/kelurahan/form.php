<?php
require_once '../dbkoneksi.php';

// Initialize variables
$id = '';
$nama = '';
$kec_id = '';
$form_action = 'create';

// Check if we're editing an existing record
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $form_action = 'update';
    
    // Fetch the record
    $sql = "SELECT * FROM kelurahan WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $nama = $row['nama'];
        $kec_id = $row['kec_id'];
    } else {
        echo "Record not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $form_action == 'create' ? 'Add' : 'Edit' ?> Kelurahan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold"><?= $form_action == 'create' ? 'Add New' : 'Edit' ?> Kelurahan</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="<?= $form_action ?>">
                <?php if ($form_action == 'update'): ?>
                <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kelurahan</label>
                    <input type="text" id="nama" name="nama" value="<?= $nama ?>" required
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="kec_id" class="block text-sm font-medium text-gray-700">Kecamatan ID</label>
                    <input type="number" id="kec_id" name="kec_id" value="<?= $kec_id ?>" required
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
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