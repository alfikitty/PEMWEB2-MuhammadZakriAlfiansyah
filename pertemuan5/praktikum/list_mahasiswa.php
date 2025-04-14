<?php 
require_once 'dbkoneksi.php';

$sql = "SELECT * FROM mahasiswa ORDER BY thn_masuk DESC";
$query = $dbh->query($sql);


?>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tanggal Lahir</th>
        <th>Email</th>
        <th>Tahun Masuk</th>
        <th>SKS Lulus</th>
        <th>IPK</th>
        <th>Prodi</th>
    </tr>
    <?php foreach ($query as $row) { ?>
        <tr>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tmp_lahir'] ?></td>
            <td><?= $row['tgl_lahir'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['thn_masuk'] ?></td>
            <td><?= $row['sks_lulus'] ?></td>
            <td><?= $row['ipk'] ?></td>
            <td><?= $row['prodi_id'] ?></td>
        </tr>
    <?php } ?>

</table>