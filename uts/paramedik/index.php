<?php
require_once '../dbkoneksi.php';
$sql = "SELECT p.*, u.nama as unit_kerja_nama 
        FROM paramedik p 
        LEFT JOIN unit_kerja u ON p.unit_kerja_id = u.id 
        ORDER BY p.nama";
try {
    $rs = $dbh->query($sql);
} catch (PDOException $e) {
    echo "Query error: " . $e->getMessage();
    die();
}

// Get status message if any
$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';
?>

<?php include '../components/head.php'; ?>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../components/sidebar.php'; ?>

        <main class="flex-1 p-6">
            <div class="container mx-auto p-4">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Paramedik Management</h1>
                    <a href="../index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to Home</a>
                </div>
                
                <?php if ($status): ?>
                <div class="mb-4 p-4 rounded <?= $status == 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' ?>">
                    <?php 
                        switch($status) {
                            case 'created': echo "Paramedik successfully created!"; break;
                            case 'updated': echo "Paramedik successfully updated!"; break;
                            case 'deleted': echo "Paramedik successfully deleted!"; break;
                            case 'error': echo $message; break;
                        }
                    ?>
                </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <a href="form.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add New Paramedik</a>
                </div>
                
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telpon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = 1; ?>
                            <?php while ($row = $rs->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $row['nama'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= ucfirst($row['kategori']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row['telpon'] ?? '-' ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row['unit_kerja_nama'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="view.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>
                                    <a href="form.php?id=<?= $row['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                    <a href="process.php?action=delete&id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>