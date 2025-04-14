<?php
require_once '../dbkoneksi.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Fetch kelurahan details
$sql = "SELECT * FROM kelurahan WHERE id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id]);
$kelurahan = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kelurahan) {
    echo "Record not found.";
    exit;
}

// Fetch patients from this kelurahan
$sql = "SELECT * FROM pasien WHERE kelurahan_id = ? ORDER BY nama";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id]);
$pasien_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kelurahan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Kelurahan Details</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Kelurahan Information</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="text-sm text-gray-900"><?= $kelurahan['id'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="text-sm text-gray-900"><?= $kelurahan['nama'] ?></dd>
                    
                    <dt class="text-sm font-medium text-gray-500">Kecamatan ID</dt>
                    <dd class="text-sm text-gray-900"><?= $kelurahan['kec_id'] ?></dd>
                </dl>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Patients from this Kelurahan</h2>
                <?php if (count($pasien_list) > 0): ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($pasien_list as $pasien): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $pasien['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $pasien['kode'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $pasien['nama'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $pasien['gender'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="../pasien/view.php?id=<?= $pasien['id'] ?>" class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-gray-500">No patients found in this kelurahan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>