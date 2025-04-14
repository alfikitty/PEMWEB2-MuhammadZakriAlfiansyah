<?php
require_once 'dbkoneksi.php';

// Query to get all prodi records
$sql = "SELECT * FROM prodi ORDER BY kode";
$rs = $dbh->query($sql);
?>

<div class="container mx-auto p-4 mt-8">
    <h3 class="text-xl font-bold mb-4">Daftar Program Studi</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Kaprodi</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($row = $rs->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                    <td class="px-4 py-2 border"><?= $row['kode'] ?></td>
                    <td class="px-4 py-2 border"><?= $row['nama'] ?></td>
                    <td class="px-4 py-2 border"><?= $row['kaprodi'] ?></td>
                    <td class="px-4 py-2 border text-center">
                        <div class="flex justify-center gap-2">
                            <a href="prodi.php?id_edit=<?= $row['id'] ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">
                                Edit
                            </a>
                            <form method="POST" action="proses_prodi.php" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                <input type="hidden" name="id_edit" value="<?= $row['id'] ?>">
                                <button type="submit" name="proses" value="Hapus" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>