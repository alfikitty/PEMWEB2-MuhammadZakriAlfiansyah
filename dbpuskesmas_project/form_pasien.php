<?php
require_once 'dbkoneksi.php';
$kelurahans = $dbh->query("SELECT * FROM kelurahan")->fetchAll();
$id = $_GET['id'] ?? '';
$data = null;
if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}
?>
<form method="POST" action="proses_pasien.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">
    <label>Kode:</label><br>
    <input type="text" name="kode" value="<?= $data['kode'] ?? '' ?>"><br>
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>"><br>
    <label>Tempat Lahir:</label><br>
    <input type="text" name="tmp_lahir" value="<?= $data['tmp_lahir'] ?? '' ?>"><br>
    <label>Tanggal Lahir:</label><br>
    <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?? '' ?>"><br>
    <label>Gender:</label><br>
    <input type="radio" name="gender" value="L" <?= ($data['gender'] ?? '') == 'L' ? 'checked' : '' ?>> Laki-Laki
    <input type="radio" name="gender" value="P" <?= ($data['gender'] ?? '') == 'P' ? 'checked' : '' ?>> Perempuan<br>
    <label>Kelurahan:</label><br>
    <select name="kelurahan_id">
        <?php foreach ($kelurahans as $kel): ?>
            <option value="<?= $kel['id'] ?>" <?= ($data['kelurahan_id'] ?? '') == $kel['id'] ? 'selected' : '' ?>>
                <?= $kel['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $data['email'] ?? '' ?>"><br>
    <label>Alamat:</label><br>
    <textarea name="alamat"><?= $data['alamat'] ?? '' ?></textarea><br>
    <button type="submit" name="proses" value="Simpan">Simpan</button>
    <button type="submit" name="proses" value="Batal">Batal</button>
</form>