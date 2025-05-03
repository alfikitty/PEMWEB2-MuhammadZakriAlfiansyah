<?php
require_once '../dbkoneksi.php';

// Initialize variables
$id = '';
$kode = '';
$nama = '';
$tmp_lahir = '';
$tgl_lahir = '';
$gender = '';
$email = '';
$alamat = '';
$kelurahan_id = '';
$form_action = 'create';

// Check if we're editing an existing record
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $form_action = 'update';
    
    // Fetch the record
    $sql = "SELECT * FROM pasien WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $kode = $row['kode'];
        $nama = $row['nama'];
        $tmp_lahir = $row['tmp_lahir'];
        $tgl_lahir = $row['tgl_lahir'];
        $gender = $row['gender'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $kelurahan_id = $row['kelurahan_id'];
    } else {
        echo "Record not found.";
        exit;
    }
}

// Fetch kelurahan for dropdown
$sql_kelurahan = "SELECT * FROM kelurahan ORDER BY nama";
$rs_kelurahan = $dbh->query($sql_kelurahan);

// Fetch unit_kerja for dropdown
$sql_unit_kerja = "SELECT * FROM unit_kerja ORDER BY nama";
$rs_unit_kerja = $dbh->query($sql_unit_kerja);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $form_action == 'create' ? 'Add' : 'Edit' ?> Pasien</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold"><?= $form_action == 'create' ? 'Add New' : 'Edit' ?> Pasien</h1>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="<?= $form_action ?>">
                <?php if ($form_action == 'update'): ?>
                <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
                    <input type="text" id="kode" name="kode" value="<?= $kode ?>" required
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?= $nama ?>" required
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="tmp_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" id="tmp_lahir" name="tmp_lahir" value="<?= $tmp_lahir ?>"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $tgl_lahir ?>"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" 
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                        <option value="L" <?= $gender == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= $gender == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="<?= $email ?>"
                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                </div>
                
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"><?= $alamat ?></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="kelurahan_id" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                    <select id="kelurahan_id" name="kelurahan_id" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                        <option value="">-- Pilih Kelurahan --</option>
                        <?php while ($kelurahan = $rs_kelurahan->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $kelurahan['id'] ?>" <?= $kelurahan_id == $kelurahan['id'] ? 'selected' : '' ?>>
                            <?= $kelurahan['nama'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
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