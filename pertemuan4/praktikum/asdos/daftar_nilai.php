<?php 
require_once 'nilai_mahasiswa.php';

$data_mhs =[];

// Data Awal
$data_mhs[] = new NilaiMahasiswa("Muhammad Zakri ALfiansyah", "Pemrograman Web", 78, 89, 80);
$data_mhs[] = new NilaiMahasiswa("ahmad dhani", "Pemrograman Web", 47, 68, 85);
$data_mhs[] = new NilaiMahasiswa("haryanto anwar", "Pemrograman Web", 57, 78, 75);

// Proses data jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $matakuliah = $_POST["matkul"];
    $nilai_uts = $_POST["uts"];
    $nilai_uas = $_POST["uas"];
    $nilai_tugas = $_POST["tugas"];

    // Bikin objek NilaiMahasiswa dan masukan ke dalam array  
    $data_mhs[] = new NilaiMahasiswa($nama, $matakuliah, $nilai_uts, $nilai_uas, $nilai_tugas);
}
?>

<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2 {
            text-align: center;
        }
        th {
            background: green;
        }
        td {
            background: skyblue;
        }
    </style>
</head>
<body>
<h2>Input Data Mahasiswa</h2>

<form method="POST">
    <label for="">Nama</label>
    <input type="text" name="nama" id=""> <br><br>
    <label for="">Mata Kuliah</label>
    <select name="matkul">
        <option value="Pemrograman Web 2">Pemrograman Web 2</option>
        <option value="UI/UX">User Interface dan User Experience</option>
        <option value="Komunikasi Efektif">Komunikasi Efektif</option>
        <option value="Bahasa Inggris 1">Bahasa Inggris 1</option>
    </select> <br> <br>
    <label for="">Nilai UTS</label>
    <input type="number" name="uts" id=""> <br><br>
    <label for="">Nilai UAS</label>
    <input type="number" name="uas" id=""> <br><br>
    <label for="">Nilai Tugas</label>
    <input type="number" name="tugas" id=""> <br><br>
    <input type="submit" name="submit" value="Simpan">
</form>

<h3>Daftar Nilai Mahasiswa</h3>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Mata Kuliah</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Tugas</th>
            <th>Nilai Akhir</th>
            <th>Kelulusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach($data_mhs as $mhs){
            echo "<tr>";
            echo "<td>".$nomor."</td>";
            echo "<td>".$mhs->nama."</td>";
            echo "<td>".$mhs->matakuliah."</td>";
            echo "<td>".$mhs->nilai_uts."</td>";
            echo "<td>".$mhs->nilai_uas."</td>";
            echo "<td>".$mhs->nilai_tugas."</td>";
            echo "<td>". number_format($mhs->getNA(), 2). "</td>";
            echo "<td>".$mhs->kelulusan(). "</td>";
            echo "</tr>";
            $nomor++;
        }

        ?>
    </tbody>
</table>
</body>
</html>