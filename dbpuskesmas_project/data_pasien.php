<?php
require_once 'dbkoneksi.php';
$sql = "SELECT pasien.*, kelurahan.nama AS nama_kelurahan FROM pasien 
        JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id";
$rs = $dbh->query($sql);
?>
<a href="form_pasien.php">Tambah Pasien</a>
<table border="1">
    <thead>
        <tr>
            <th>Kode</th><th>Nama</th><th>Tempat Lahir</th>
            <th>Tanggal Lahir</th><th>Gender</th><th>Kelurahan</th>
            <th>Email</th><th>Alamat</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rs as $row): ?>
        <tr>
            <td><?= $row['kode'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tmp_lahir'] ?></td>
            <td><?= $row['tgl_lahir'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['nama_kelurahan'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td>
                <a href="form_pasien.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="proses_pasien.php?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>