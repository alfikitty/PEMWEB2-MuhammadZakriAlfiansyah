<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $matkul = isset($_POST['matkul']) ? trim($_POST['matkul']) : '';
    $nilai_uts = isset($_POST['nilai_uts']) ? floatval($_POST['nilai_uts']) : 0;
    $nilai_uas = isset($_POST['nilai_uas']) ? floatval($_POST['nilai_uas']) : 0;
    $nilai_tugas = isset($_POST['nilai_tugas']) ? floatval($_POST['nilai_tugas']) : 0;

    $total_nilai = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    $kelulusan = $total_nilai >= 60 ? "Lulus! Selamat" : "Tidak Lulus, Silakan Coba Lagi";
    
    $grade = "E (Sangat Kurang)";
    if ($total_nilai >= 85) {
        $grade = "A (Sangat Baik)";
    } elseif ($total_nilai >= 70) {
        $grade = "B (Baik)";
    } elseif ($total_nilai >= 56) {
        $grade = "C (Cukup)";
    } elseif ($total_nilai >= 36) {
        $grade = "D (Kurang)";
    }

    $_SESSION["hasil_nilai"] = [
        "nama" => $nama,
        "matkul" => $matkul,
        "nilai_uts" => $nilai_uts,
        "nilai_uas" => $nilai_uas,
        "nilai_tugas" => $nilai_tugas,
        "total_nilai" => $total_nilai,
        "kelulusan" => $kelulusan,
        "grade" => $grade
    ];
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$hasil_nilai = $_SESSION["hasil_nilai"] ?? null;
unset($_SESSION["hasil_nilai"]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Form Nilai Siswa</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-semibold mb-4">Form Nilai Siswa</h2>
        <form method="POST">
            <label class="block mb-2 text-sm font-medium">Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full p-2 border rounded mb-4" required>
            
            <label class="block mb-2 text-sm font-medium">Mata Kuliah</label>
            <select name="matkul" class="w-full p-2 border rounded mb-4">
                <option value="Dasar Dasar Pemrograman">Dasar Dasar Pemrograman</option>
                <option value="Struktur Data">Struktur Data</option>
                <option value="Basis Data">Basis Data</option>
            </select>
            
            <label class="block mb-2 text-sm font-medium">Nilai UTS</label>
            <input type="number" name="nilai_uts" placeholder="Nilai UTS" class="w-full p-2 border rounded mb-4" required>
            
            <label class="block mb-2 text-sm font-medium">Nilai UAS</label>
            <input type="number" name="nilai_uas" placeholder="Nilai UAS" class="w-full p-2 border rounded mb-4" required>
            
            <label class="block mb-2 text-sm font-medium">Nilai Tugas/Praktikum</label>
            <input type="number" name="nilai_tugas" placeholder="Nilai Tugas" class="w-full p-2 border rounded mb-4" required>
            
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Simpan</button>
        </form>

        <?php if ($hasil_nilai): ?>
        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
            <h3 class="text-lg font-semibold">Hasil:</h3>
            <p><strong>Nama:</strong> <?= htmlspecialchars($hasil_nilai['nama']) ?></p>
            <p><strong>Mata Kuliah:</strong> <?= htmlspecialchars($hasil_nilai['matkul']) ?></p>
            <p><strong>Nilai UTS:</strong> <?= $hasil_nilai['nilai_uts'] ?></p>
            <p><strong>Nilai UAS:</strong> <?= $hasil_nilai['nilai_uas'] ?></p>
            <p><strong>Nilai Tugas:</strong> <?= $hasil_nilai['nilai_tugas'] ?></p>
            <p><strong>Nilai Akhir:</strong> <?= $hasil_nilai['total_nilai'] ?></p>
            <p><strong>Status:</strong> <?= $hasil_nilai['kelulusan'] ?></p>
            <p><strong>Predikat:</strong> <?= $hasil_nilai['grade'] ?></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>